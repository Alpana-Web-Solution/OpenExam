@extends('layouts.admin')

@section('content')
  <div class="container">
    @include('layouts.parts.message')
    <div class="row justify-content-center">
      <div class="col-sm-12">
      	<div class="card">
      		<div class="card-header">
      			{{__("Create A Tag.")}}
      		</div>
      		<div class="card-body">
      			<form action="{{route('admin.tag.store')}}" method="POST">
              @csrf
              <x-form.text-input
                label="{{__('Tag Name')}}"
                name="name"
                placeholder="{{__('Please input a Name')}}"
                addClass='form-control shadow-sm'
                error="$errors->first('name')"
                value="{{$name ?? ''}}"
                required />

              <button type="submit" class="btn btn-success">Save</button>
            </form>
      		</div>
      		<div class="card-footer">
      			<a class="btn btn-primary" href="{{route('admin.tag.index')}}">Back</a>
      		</div>

      	</div>
      </div>
  </div>
</div>
@endsection
