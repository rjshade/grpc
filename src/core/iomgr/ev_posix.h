/*
 *
 * Copyright 2015-2016, Google Inc.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are
 * met:
 *
 *     * Redistributions of source code must retain the above copyright
 * notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above
 * copyright notice, this list of conditions and the following disclaimer
 * in the documentation and/or other materials provided with the
 * distribution.
 *     * Neither the name of Google Inc. nor the names of its
 * contributors may be used to endorse or promote products derived from
 * this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 */

#ifndef GRPC_INTERNAL_CORE_IOMGR_EV_POSIX_H
#define GRPC_INTERNAL_CORE_IOMGR_EV_POSIX_H

typedef struct grpc_fd grpc_fd;

typedef struct grpc_event_engine_vtable {
  grpc_fd *(*fd_create)(int fd, const char *name);
  int (*fd_wrapped_fd)(grpc_fd *fd);
  void (*fd_orphan)(grpc_exec_ctx *exec_ctx, grpc_fd *fd, grpc_closure *on_done,
                      int *release_fd, const char *reason);
  void (*fd_shutdown)(grpc_exec_ctx *exec_ctx, grpc_fd *fd);
  void (*fd_notify_on_read)(grpc_exec_ctx *exec_ctx, grpc_fd *fd,
                              grpc_closure *closure);
  void (*fd_notify_on_write)(grpc_exec_ctx *exec_ctx, grpc_fd *fd,
                               grpc_closure *closure);
} grpc_event_engine_vtable;

extern const grpc_event_engine_vtable *grpc_event_engine;

void grpc_event_engine_init(void);
void grpc_event_engine_shutdown(void);

/* Create a wrapped file descriptor.
   Requires fd is a non-blocking file descriptor.
   This takes ownership of closing fd. */
grpc_fd *grpc_fd_create(int fd, const char *name);

/* Return the wrapped fd, or -1 if it has been released or closed. */
int grpc_fd_wrapped_fd(grpc_fd *fd);

/* Releases fd to be asynchronously destroyed.
   on_done is called when the underlying file descriptor is definitely close()d.
   If on_done is NULL, no callback will be made.
   If release_fd is not NULL, it's set to fd and fd will not be closed.
   Requires: *fd initialized; no outstanding notify_on_read or
   notify_on_write.
   MUST NOT be called with a pollset lock taken */
void grpc_fd_orphan(grpc_exec_ctx *exec_ctx, grpc_fd *fd, grpc_closure *on_done,
                    int *release_fd, const char *reason);

/* Cause any current callbacks to error out with GRPC_CALLBACK_CANCELLED. */
void grpc_fd_shutdown(grpc_exec_ctx *exec_ctx, grpc_fd *fd);

/* Register read interest, causing read_cb to be called once when fd becomes
   readable, on deadline specified by deadline, or on shutdown triggered by
   grpc_fd_shutdown.
   read_cb will be called with read_cb_arg when *fd becomes readable.
   read_cb is Called with status of GRPC_CALLBACK_SUCCESS if readable,
   GRPC_CALLBACK_TIMED_OUT if the call timed out,
   and CANCELLED if the call was cancelled.

   Requires:This method must not be called before the read_cb for any previous
   call runs. Edge triggered events are used whenever they are supported by the
   underlying platform. This means that users must drain fd in read_cb before
   calling notify_on_read again. Users are also expected to handle spurious
   events, i.e read_cb is called while nothing can be readable from fd  */
void grpc_fd_notify_on_read(grpc_exec_ctx *exec_ctx, grpc_fd *fd,
                            grpc_closure *closure);

/* Exactly the same semantics as above, except based on writable events.  */
void grpc_fd_notify_on_write(grpc_exec_ctx *exec_ctx, grpc_fd *fd,
                             grpc_closure *closure);

#endif // GRPC_INTERNAL_CORE_IOMGR_EV_POSIX_H
