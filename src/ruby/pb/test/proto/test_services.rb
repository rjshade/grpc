# Generated by the protocol buffer compiler.  DO NOT EDIT!
# Source: test/proto/test.proto for package 'grpc.testing'

require 'grpc'
require 'test/proto/test'

module Grpc
  module Testing
    module TestService

      # TODO: add proto service documentation here
      class Service

        include GRPC::GenericService

        self.marshal_class_method = :encode
        self.unmarshal_class_method = :decode
        self.service_name = 'grpc.testing.TestService'

        rpc :EmptyCall, Empty, Empty
        rpc :UnaryCall, SimpleRequest, SimpleResponse
        rpc :StreamingOutputCall, StreamingOutputCallRequest, stream(StreamingOutputCallResponse)
        rpc :StreamingInputCall, stream(StreamingInputCallRequest), StreamingInputCallResponse
        rpc :FullDuplexCall, stream(StreamingOutputCallRequest), stream(StreamingOutputCallResponse)
        rpc :HalfDuplexCall, stream(StreamingOutputCallRequest), stream(StreamingOutputCallResponse)
      end

      Stub = Service.rpc_stub_class
    end
    module UnimplementedService

      # TODO: add proto service documentation here
      class Service

        include GRPC::GenericService

        self.marshal_class_method = :encode
        self.unmarshal_class_method = :decode
        self.service_name = 'grpc.testing.UnimplementedService'

        rpc :UnimplementedCall, Empty, Empty
      end

      Stub = Service.rpc_stub_class
    end
    module ReconnectService

      # TODO: add proto service documentation here
      class Service

        include GRPC::GenericService

        self.marshal_class_method = :encode
        self.unmarshal_class_method = :decode
        self.service_name = 'grpc.testing.ReconnectService'

        rpc :Start, Empty, Empty
        rpc :Stop, Empty, ReconnectInfo
      end

      Stub = Service.rpc_stub_class
    end
  end
end
