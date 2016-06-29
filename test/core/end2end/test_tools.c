#include "test/core/end2end/test_tools.h"

#include "test/core/util/test_config.h"

gpr_timespec n_seconds_time(int n) {
  return GRPC_TIMEOUT_SECONDS_TO_DEADLINE(n);
}

gpr_timespec default_test_timeout(void) { return n_seconds_time(10); }
