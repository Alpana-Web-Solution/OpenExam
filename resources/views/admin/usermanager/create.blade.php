@extends('layouts.admin')

@section('content')
  <div class="container-fluid">
  	@include('layouts.parts.message')
    <div class="row justify-content-center">
      <div class="col-sm-12">
      	<div class="card shadow-sm">
      		<div class="card-header">
      			{{trans('Create a new User Account.')}}
      		</div>
      		<div class="card-body">
      			<form action="{{route('admin.usermanager.store')}}" method="POST">
              @csrf
                                      <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- User Name -->
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Contact Number -->
                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>
                            <div class='col-md-6'>
                            <input class="form-control mobile @error('mobile') is-invalid @enderror" id="mobile" name="mobile" type="number" value="{{ old('mobile') }}" autofocus>
                            @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            </div>
                        </div>

                  <div class="form-group row">
                      <label for="pincode_id" class="col-md-4 col-form-label text-md-right">{{ __('Pincode') }}</label>

                      <div class="col-md-6">
                          <input id="pincode_id" type="number" class="form-control @error('pincode_id') is-invalid @enderror" name="pincode_id" value="{{ old('pincode_id') }}" autocomplete="pincode_id" autofocus >

                          @error('pincode_id')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                  </div>


                        <!-- Blood Group -->
                        <div class="form-group row">
                            <label for="blood_group" class="col-md-4 col-form-label text-md-right">{{ __('Blood Group') }}</label>

                            <div class="col-md-6">
                                <select class="form-control @error('blood_group') is-invalid @enderror" id="blood_group" value="{{ old('blood_group') }}" name="blood_group">
                                  <option value="1">A+</option>
                                  <option value="2">A-</option>
                                  <option value="3">B+</option>
                                  <option value="4">B-</option>
                                  <option value="5">O+</option>
                                  <option value="6">O-</option>
                                  <option value="7">AB+</option>
                                  <option value="8">AB-</option>
                                </select>
                                @error('blood_group')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Is Donor -->
                        <div class="form-group row">
                            <label for="is_donor" class="col-md-4 col-form-label text-md-right">{{ __('Are you a blood donor?') }}</label>

                            <div class="col-md-6">
                                <select class="form-control @error('is_donor') is-invalid @enderror" id="is_donor"
                                value="{{ old('is_donor') }}" name="is_donor" >
                                <option value="1">{{__('Yes')}}</option>
                                <option value="0">{{__("No")}}</option>
                                </select>
                                @error('is_donor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Donor -->
                        <div class="form-group row">
                            <label for="last_donated" class="col-md-4 col-form-label text-md-right">{{ __('Last Donation') }}</label>

                            <div class="col-md-6">
                            <input id="schedule_date" name="last_donated" value="{{old('last_donated')}}"  placeholder="{{__('Last Donation')}}" type="date" class="form-control" required="required">
                            </div>
                        </div>
                                    <!-- Is Admin -->
              <div class="form-group row">
                  <label for="is_admin" class="col-md-4 col-form-label text-md-right">{{ __('Make An Admin?') }}</label>

                  <div class="col-md-6">
                      <select class="form-control @error('is_admin') is-invalid @enderror" id="is_admin"
                      value=" name="is_admin" >
                      <option value="1" >{{__("Yes")}}</option>
                      <option value="0" selected>{{__("No")}}</option>
                      </select>
                      @error('is_admin')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>


              </div>
              <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

              <button type="submit" class="btn btn-pill btn-success btn-sm">{{trans("Save")}}</button>
            </form>
      		</div>
      		<div class="card-footer">
      			<a class="btn btn-pill btn-primary btn-sm" href="{{url()->previous()}}">{{trans('Back')}}</a>
      		</div>

      	</div>
      </div>
  </div>
</div>
@endsection
