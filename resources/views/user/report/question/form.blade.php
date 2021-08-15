@extends('layouts.user')

@section('content')
  <div class="container">
  	@include('layouts.parts.message')
    <div class="row justify-content-center">
      <div class="col-sm-12">
      	<div class="card">
      		<div class="card-header">
      			{{__("Reporting question :")}}
                  <p>
                      {{$question->question}}
                  </p>
      		</div>
      		<div class="card-body">
      			<form action="{{route('user.question.report',[$result->id,$question->id])}}" method="POST" enctype="multipart/form-data">
                 @csrf
                  <div class="form-group row {{ $errors->has('report') ? 'has-error' : '' }}">
                                   <label for="report" class="col-md-4 col-form-label text-md-right">{{ __('Your Report') }}</label>
                   <div class="col-md-6">
                    <input id="report" type="text" class="form-control @error('report') is-invalid @enderror" name="report" value="{{ old('report') ?? $report ?? '' }}" autocomplete="report" autofocus >

                    @error('report')
                        <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                  </div>
                 </div>
                 <button class="btn btn-pill btn-success text-white" type="submit">{{__('Report')}}</button>
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
