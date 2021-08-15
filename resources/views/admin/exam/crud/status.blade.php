@extends('layouts.admin')
@section('content')
  <div class="container">
  	@include('layouts.parts.message')
    <div class="row justify-content-center">
      <div class="col-sm-12">
      	<div class="card">
      		<div class="card-header">
      			{{__('Change Status of Your Examination')}}
      		</div>
      		<div class="card-body">
                  <div>
                      <h5>Please note:</h5>
                      <p>
                          {{__('Once you have changed your examination status it is not possible to edit any question or exam details. Change status when you are certain.')}}
                      </p>
                  </div>
      			<form action="{{route('admin.exam.statusupdate',$exam->id)}}" method="POST">
              @csrf
                    <select class="class="custom-select" name="status" >{{__('Status')}}
                        <option value="1">{{__('Active')}}</option>
                        <option value="2">{{__('Ended')}}</option>
                        <option value="3">{{__('Cancelled')}}</option>
                    </select>
              <button type="submit" class="btn btn-pills btn-success">{{__('Save')}}</button>
            </form>
      		</div>
      		<div class="card-footer">
                <a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.exam.show',$exam->id)}}">{{__('Back')}}</a>
      		</div>

      	</div>
      </div>
  </div>
</div>
@endsection
