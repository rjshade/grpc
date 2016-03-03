#!/bin/bash
# Copyright 2015-2016, Google Inc.
# All rights reserved.
#
# Redistribution and use in source and binary forms, with or without
# modification, are permitted provided that the following conditions are
# met:
#
#     * Redistributions of source code must retain the above copyright
# notice, this list of conditions and the following disclaimer.
#     * Redistributions in binary form must reproduce the above
# copyright notice, this list of conditions and the following disclaimer
# in the documentation and/or other materials provided with the
# distribution.
#     * Neither the name of Google Inc. nor the names of its
# contributors may be used to endorse or promote products derived from
# this software without specific prior written permission.
#
# THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
# "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
# LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
# A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
# OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
# SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
# LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
# DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
# THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
# (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
# OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

set -ex

# change to grpc repo root
cd $(dirname $0)/../..

ROOT=`pwd`
export LD_LIBRARY_PATH=$ROOT/libs/$CONFIG
export DYLD_LIBRARY_PATH=$ROOT/libs/$CONFIG
export PATH=$ROOT/bins/$CONFIG:$ROOT/bins/$CONFIG/protobuf:$PATH
export CFLAGS="-I$ROOT/include -std=c89"
export LDFLAGS="-L$ROOT/libs/$CONFIG"
export GRPC_PYTHON_BUILD_WITH_CYTHON=1
export GRPC_PYTHON_ENABLE_CYTHON_TRACING=1

if [ "$CONFIG" = "gcov" ]
then
  tox
else
  $ROOT/.tox/py27/bin/python $ROOT/setup.py test
fi

mkdir -p $ROOT/reports
rm -rf $ROOT/reports/python-coverage
(mv -T $ROOT/htmlcov $ROOT/reports/python-coverage) || true
