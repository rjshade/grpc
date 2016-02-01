#!/usr/bin/env python
# Copyright 2016, Google Inc.
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

"""Definition of targets to build artifacts."""

import jobset


def create_docker_jobspec(name, dockerfile_dir, shell_command, environ={},
                   flake_retries=0, timeout_retries=0):
  """Creates jobspec for a task running under docker."""
  environ = environ.copy()
  environ['RUN_COMMAND'] = shell_command

  docker_args=[]
  for k,v in environ.iteritems():
    docker_args += ['-e', '%s=%s' % (k, v)]
  docker_env = {'DOCKERFILE_DIR': dockerfile_dir,
                'DOCKER_RUN_SCRIPT': 'tools/jenkins/docker_run.sh',
                'OUTPUT_DIR': 'artifacts'}
  jobspec = jobset.JobSpec(
          cmdline=['tools/jenkins/build_and_run_docker.sh'] + docker_args,
          environ=docker_env,
          shortname='build_artifact.%s' % (name),
          timeout_seconds=30*60,
          flake_retries=flake_retries,
          timeout_retries=timeout_retries)
  return jobspec


def create_jobspec(name, cmdline, environ=None, shell=False,
                   flake_retries=0, timeout_retries=0):
  """Creates jobspec."""
  jobspec = jobset.JobSpec(
          cmdline=cmdline,
          environ=environ,
          shortname='build_artifact.%s' % (name),
          timeout_seconds=10*60,
          flake_retries=flake_retries,
          timeout_retries=timeout_retries,
          shell=shell)
  return jobspec


def macos_arch_env(arch):
  """Returns environ specifying -arch arguments for make."""
  if arch == 'x86':
    arch_arg = '-arch i386'
  elif arch == 'x64':
    arch_arg = '-arch x86_64'
  else:
    raise Exception('Unsupported arch')
  return {'CFLAGS': arch_arg, 'LDFLAGS': arch_arg}


class CSharpExtArtifact:
  """Builds C# native extension library"""

  def __init__(self, platform, arch):
    self.name = 'csharp_ext_%s_%s' % (platform, arch)
    self.platform = platform
    self.arch = arch
    self.labels = ['artifact', 'csharp', platform, arch]

  def pre_build_jobspecs(self):
    if self.platform == 'windows':
      return [create_jobspec('prebuild_%s' % self.name,
                             ['tools\\run_tests\\pre_build_c.bat'],
                             shell=True,
                             flake_retries=5,
                             timeout_retries=2)]
    else:
      return []

  def build_jobspec(self):
    if self.platform == 'windows':
      msbuild_platform = 'Win32' if self.arch == 'x86' else self.arch
      return create_jobspec(self.name,
                            ['tools\\run_tests\\build_artifact_csharp.bat',
                             'vsprojects\\grpc_csharp_ext.sln',
                             '/p:Configuration=Release',
                             '/p:PlatformToolset=v120',
                             '/p:Platform=%s' % msbuild_platform],
                            shell=True)
    else:
      environ = {'CONFIG': 'opt',
                 'EMBED_OPENSSL': 'true',
                 'EMBED_ZLIB': 'true'}
      if self.platform == 'linux':
        return create_docker_jobspec(self.name,
            'tools/dockerfile/grpc_artifact_linux_%s' % self.arch,
            'tools/run_tests/build_artifact_csharp.sh')
      else:
        environ.update(macos_arch_env(self.arch))
        return create_jobspec(self.name,
                              ['tools/run_tests/build_artifact_csharp.sh'],
                              environ=environ)

  def __str__(self):
    return self.name

node_gyp_arch_map = {
  'x86': 'ia32',
  'x64': 'x64'
}

class NodeExtArtifact:
  """Builds Node native extension"""

  def __init__(self, platform, arch):
    self.name = 'node_ext_{0}_{1}'.format(platform, arch)
    self.platform = platform
    self.arch = arch
    self.gyp_arch = node_gyp_arch_map[arch]
    self.labels = ['artifact', 'node', platform, arch]

  def pre_build_jobspecs(self):
    return []

  def build_jobspec(self):
    if self.platform == 'windows':
      return create_jobspec(self.name,
                            ['tools\\run_tests\\build_artifact_node.bat',
                             self.gyp_arch],
                            shell=True)
    else:
      if self.platform == 'linux':
        return create_docker_jobspec(
            self.name,
            'tools/dockerfile/grpc_artifact_linux_{}'.format(self.arch),
            'tools/run_tests/build_artifact_node.sh {}'.format(self.gyp_arch))
      else:
        return create_jobspec(self.name,
                              ['tools/run_tests/build_artifact_node.sh',
                               self.gyp_arch])


def targets():
  """Gets list of supported targets"""
  return [Cls(platform, arch)
          for Cls in (CSharpExtArtifact, NodeExtArtifact)
          for platform in ('linux', 'macos', 'windows')
          for arch in ('x86', 'x64')]
