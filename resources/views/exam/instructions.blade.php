@extends('layouts.app')

@section('content')
  <div class="container">
  	@include('layouts.parts.message')
    <div class="row justify-content-center">
      <div class="col-sm-12">
      	<div class="card">
      		<div class="card-header">
                  {{$exam->name}}
      			<div class="card-header-actions">
              <a class="btn btn-pill btn-primary btn-sm" href="{{route('exam.index')}}">{{__('Back')}}</a>
            </div>
      		</div>
      		<div class="card-body">
                  <h4>Instruction :</h4>
                  <p>
                      {!! $exam->instruction !!}
                  </p>
      		</div>
      		<div class="card-footer">
      			<a class="btn btn-pill btn-success" href="{{route('exam.attend',$exam->id)}}">{{__('Attend')}}</a>
      		</div>

      	</div>
      </div>
  </div>
</div>
@endsection
