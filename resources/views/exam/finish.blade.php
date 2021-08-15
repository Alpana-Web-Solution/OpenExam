@extends('layouts.app')

@section('content')
  <div class="container">
  	@include('layouts.parts.message')
    <div class="row justify-content-center">
      <div class="col-sm-12">
      	<div class="card">
      		<div class="card-header">
                  {{__('Finish Examination now?')}}
      			<div class="card-header-actions">
              {{-- <a class="btn btn-primary btn-sm" href="{{route('route.create')}}">{{trans('Create')}}</a> --}}
            </div>
      		</div>
      		<div class="card-body">

      		</div>
      		<div class="card-footer">
      			<a class="btn btn-pill btn-primary" href="{{url()->previous()}}">{{__('Back')}}</a>
      		</div>

      	</div>
      </div>
  </div>
</div>
@endsection
