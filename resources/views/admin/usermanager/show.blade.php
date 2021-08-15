@extends('layouts.admin')

@section('content')
  <div class="container-fluid">
  	@include('layouts.parts.message')
    <div class="row justify-content-center">
      <div class="col-sm-12">
      	<div class="card shadow-sm">
      		<div class="card-header">
            <div class="card-header-actions">
            <form action="{{route('admin.usermanager.resetpassword',$data->id)}}" method="POST">
              @csrf
              <button class="btn btn-pill btn-primary btn-sm" type="submit">{{__("Send Reset Password Mail")}}</button>

            </form>
          </div>
      			<h4>{{$data->name}}</h4> {{trans('User Details')}}
      		</div>
      		<div class="card-body">
      			<strong>{{__('Username')}} : {{$data->username}}</strong><br>
            {{trans('Email')}} : {{$data->email}}<br>
            {{trans('Mobile')}} : {{$data->mobile}}<br>

      		</div>
      		<div class="card-footer">
            <a class="btn btn-pill btn-primary btn-sm" href="{{url()->previous()}}">{{__('Back')}}</a>
      			<a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.usermanager.edit',$data->id)}}">{{trans('Edit')}}</a>
      		</div>

      	</div>
      </div>
  </div>
</div>
@endsection
