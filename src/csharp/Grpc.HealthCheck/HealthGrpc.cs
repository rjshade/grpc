// Generated by the protocol buffer compiler.  DO NOT EDIT!
// source: health.proto
#region Designer generated code

using System;
using System.Threading;
using System.Threading.Tasks;
using Grpc.Core;

namespace Grpc.Health.V1 {
  public static class Health
  {
    static readonly string __ServiceName = "grpc.health.v1.Health";

    static readonly Marshaller<global::Grpc.Health.V1.HealthCheckRequest> __Marshaller_HealthCheckRequest = Marshallers.Create((arg) => global::Google.Protobuf.MessageExtensions.ToByteArray(arg), global::Grpc.Health.V1.HealthCheckRequest.Parser.ParseFrom);
    static readonly Marshaller<global::Grpc.Health.V1.HealthCheckResponse> __Marshaller_HealthCheckResponse = Marshallers.Create((arg) => global::Google.Protobuf.MessageExtensions.ToByteArray(arg), global::Grpc.Health.V1.HealthCheckResponse.Parser.ParseFrom);

    static readonly Method<global::Grpc.Health.V1.HealthCheckRequest, global::Grpc.Health.V1.HealthCheckResponse> __Method_Check = new Method<global::Grpc.Health.V1.HealthCheckRequest, global::Grpc.Health.V1.HealthCheckResponse>(
        MethodType.Unary,
        __ServiceName,
        "Check",
        __Marshaller_HealthCheckRequest,
        __Marshaller_HealthCheckResponse);

    // service descriptor
    public static global::Google.Protobuf.Reflection.ServiceDescriptor Descriptor
    {
      get { return global::Grpc.Health.V1.HealthReflection.Descriptor.Services[0]; }
    }

    // client interface
    [System.Obsolete("Client side interfaced will be removed in the next release. Use client class directly.")]
    public interface IHealthClient
    {
      global::Grpc.Health.V1.HealthCheckResponse Check(global::Grpc.Health.V1.HealthCheckRequest request, Metadata headers = null, DateTime? deadline = null, CancellationToken cancellationToken = default(CancellationToken));
      global::Grpc.Health.V1.HealthCheckResponse Check(global::Grpc.Health.V1.HealthCheckRequest request, CallOptions options);
      AsyncUnaryCall<global::Grpc.Health.V1.HealthCheckResponse> CheckAsync(global::Grpc.Health.V1.HealthCheckRequest request, Metadata headers = null, DateTime? deadline = null, CancellationToken cancellationToken = default(CancellationToken));
      AsyncUnaryCall<global::Grpc.Health.V1.HealthCheckResponse> CheckAsync(global::Grpc.Health.V1.HealthCheckRequest request, CallOptions options);
    }

    // server-side interface
    [System.Obsolete("Service implementations should inherit from the generated abstract base class instead.")]
    public interface IHealth
    {
      Task<global::Grpc.Health.V1.HealthCheckResponse> Check(global::Grpc.Health.V1.HealthCheckRequest request, ServerCallContext context);
    }

    // server-side abstract class
    public abstract class HealthBase
    {
      public virtual Task<global::Grpc.Health.V1.HealthCheckResponse> Check(global::Grpc.Health.V1.HealthCheckRequest request, ServerCallContext context)
      {
        throw new RpcException(new Status(StatusCode.Unimplemented, ""));
      }

    }

    // client stub
    #pragma warning disable 0618
    public class HealthClient : ClientBase<HealthClient>, IHealthClient
    #pragma warning restore 0618
    {
      public HealthClient(Channel channel) : base(channel)
      {
      }
      public HealthClient(CallInvoker callInvoker) : base(callInvoker)
      {
      }
      ///<summary>Protected parameterless constructor to allow creation of test doubles.</summary>
      protected HealthClient() : base()
      {
      }
      ///<summary>Protected constructor to allow creation of configured clients.</summary>
      protected HealthClient(ClientBaseConfiguration configuration) : base(configuration)
      {
      }

      public virtual global::Grpc.Health.V1.HealthCheckResponse Check(global::Grpc.Health.V1.HealthCheckRequest request, Metadata headers = null, DateTime? deadline = null, CancellationToken cancellationToken = default(CancellationToken))
      {
        return Check(request, new CallOptions(headers, deadline, cancellationToken));
      }
      public virtual global::Grpc.Health.V1.HealthCheckResponse Check(global::Grpc.Health.V1.HealthCheckRequest request, CallOptions options)
      {
        return CallInvoker.BlockingUnaryCall(__Method_Check, null, options, request);
      }
      public virtual AsyncUnaryCall<global::Grpc.Health.V1.HealthCheckResponse> CheckAsync(global::Grpc.Health.V1.HealthCheckRequest request, Metadata headers = null, DateTime? deadline = null, CancellationToken cancellationToken = default(CancellationToken))
      {
        return CheckAsync(request, new CallOptions(headers, deadline, cancellationToken));
      }
      public virtual AsyncUnaryCall<global::Grpc.Health.V1.HealthCheckResponse> CheckAsync(global::Grpc.Health.V1.HealthCheckRequest request, CallOptions options)
      {
        return CallInvoker.AsyncUnaryCall(__Method_Check, null, options, request);
      }
      protected override HealthClient NewInstance(ClientBaseConfiguration configuration)
      {
        return new HealthClient(configuration);
      }
    }

    // creates a new client
    public static HealthClient NewClient(Channel channel)
    {
      return new HealthClient(channel);
    }

    // creates service definition that can be registered with a server
    #pragma warning disable 0618
    public static ServerServiceDefinition BindService(IHealth serviceImpl)
    #pragma warning restore 0618
    {
      return ServerServiceDefinition.CreateBuilder(__ServiceName)
          .AddMethod(__Method_Check, serviceImpl.Check).Build();
    }

    // creates service definition that can be registered with a server
    #pragma warning disable 0618
    public static ServerServiceDefinition BindService(HealthBase serviceImpl)
    #pragma warning restore 0618
    {
      return ServerServiceDefinition.CreateBuilder(__ServiceName)
          .AddMethod(__Method_Check, serviceImpl.Check).Build();
    }

  }
}
#endregion
