@extends('layouts.user')

@section('content')
  <div class="container">
  	@include('layouts.parts.message')
    <div class="row justify-content-center">
      <div class="col-sm-12">
      	<div class="card">
      		<div class="card-header">
      			{{__("Edit")}}
      		</div>
      		<div class="card-body">
      			<form action="{{route('user.profile.update')}}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="form-group row">
                  <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                  <div class="col-md-6">
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $data->name }}" autocomplete="name" autofocus >

                      @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
              <div class="form-group row">
                  <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                  <div class="col-md-6">
                      <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $data->username }}" autocomplete="username" autofocus disabled >

                      @error('username')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
              <div class="form-group row">
                  <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('Mobile') }}</label>

                  <div class="col-md-6">
                      <input id="mobile" type="number" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ $data->mobile }}" autocomplete="mobile" autofocus >

                      @error('mobile')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>

              <!-- Address start -->
              {{-- <div class="form-group row">
                  <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                  <div class="col-md-6">
                      <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{old('address') ?? optional(auth()->user()->profile)->address }}" autocomplete="address" autofocus >

                      @error('address')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div> --}}

              <!-- Address End -->
             {{--
                        <div class="form-group row">

                          <p>Avatar Upload : </p>
                          @if(auth()->user()->avatar)
                          <br>
                          Current Avatar
                          <img src="{{auth()->user()->avatar}}" width="150" height="150">
                          @endif
                          <input type="file" name="file" class="form-control">
                        </div>
                        --}}
              <button class="btn btn-pill btn-success" type="submit">{{__('Update')}}</button>
            </form>
      		</div>
      		<div class="card-footer">
      			<a class="btn btn-pill btn-primary" href="{{url()->previous()}}">{{__('Back')}}</a>
      		</div>

      	</div>
      </div>
  </div>
</div>
@endsection
