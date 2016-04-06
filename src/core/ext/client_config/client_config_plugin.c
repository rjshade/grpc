/*
 *
 * Copyright 2015, Google Inc.
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

#include <limits.h>

static bool set_default_host_if_unset(grpc_channel_stack_builder *builder,
                                      void *arg) {
  grpc_channel_args *args =
      grpc_channel_stack_builder_get_channel_arguments(builder);
  for (size_t i = 0; i < args->num_args; i++) {
    if (0 == strcmp(args->args[i].key, GRPC_ARG_DEFAULT_AUTHORITY)) {
      return true;
    }
  }
  grpc_arg arg;
  arg.type = GRPC_ARG_STRING;
  arg.key = GRPC_ARG_DEFAULT_AUTHORITY;
  arg.value.string = grpc_get_default_authority();
  grpc_channel_stack_builder_set_channel_arguments(
      builder, grpc_channel_args_copy_and_add(args, &arg, 1));
}

void grpc_client_config_init(void) {
  grpc_lb_policy_registry_init();
  grpc_resolver_registry_init(GRPC_DEFAULT_NAME_PREFIX);
  grpc_subchannel_index_init();
  grpc_channel_init_register_stage(GRPC_CLIENT_CHANNEL, INT_MIN,
                                   set_default_host_if_unset, NULL);
  grpc_channel_init_register_stage(GRPC_CLIENT_CHANNEL, INT_MAX, append_filter,
                                   (void *)&grpc_client_channel_filter);
}

void grpc_client_config_shutdown(void) {
  grpc_subchannel_index_shutdown();
  grpc_channel_init_shutdown();
  grpc_resolver_registry_shutdown();
  grpc_lb_policy_registry_shutdown();
}
