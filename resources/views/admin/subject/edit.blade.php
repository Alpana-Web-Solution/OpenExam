@extends('layouts.admin')

@section('content')
  <div class="container">
  	@include('layouts.parts.message')
    <div class="row justify-content-center">
      <div class="col-sm-12">
      	<div class="card">
      		<div class="card-header">
      			{{__('Edit')}}
      		</div>
      		<div class="card-body">
      			<form action="{{route('admin.subject.update',$subject->id)}}" method="POST" >
              @csrf
              @method('put')
              <div>
                <div class="form-group row {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="subjectName" class="col-md-3 col-form-label text-md-right">{{ __('Subject Name') }}</label>

                    <div class="col-md-6">
                        <input  id="subjectName" type="text" class="form-control @error('subjectName') is-invalid @enderror" name="subjectName" value="{{ old('subjectName') ?? $subject->name }}" autocomplete="subjectName" autofocus >
                @error('subjectName')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    </div>

                </div>
                 <div class="form-group row {{ $errors->has('subjectCode') ? 'has-error' : '' }}">
                                  <label for="subjectCode" class="col-md-3 col-form-label text-md-right">{{ __('Subject Code') }}</label>

                  <div class="col-md-6">
                   <input  id="subjectCode" type="text" class="form-control @error('subjectCode') is-invalid @enderror" name="subjectCode" value="{{ old('subjectCode') ?? $subject->code }}" autocomplete="subjectCode" autofocus >

                   @error('subjectCode')
                       <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                       </span>
                     @enderror
                 </div>
                </div>
                 <div class="form-group row {{ $errors->has('subjectDescription') ? 'has-error' : '' }}">
                    <label for="subjectDescription" class="col-md-3 col-form-label text-md-right">{{ __('Subject Description') }}</label>

                  <div class="col-md-6">
                   <input  id="subjectDescription" type="text" class="form-control @error('subjectDescription') is-invalid @enderror" name="subjectDescription" value="{{ old('subjectDescription') ?? $subject->description }}" autocomplete="subjectDescription" autofocus >

                   @error('subjectDescription')
                       <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                       </span>
                     @enderror
                 </div>
                </div>



                {{-- Parent input --}}

                <div class="form-group row ">
                    <label for="parent" class="col-3 col-form-label text-md-right">{{__("Parent Subject")}}</label>
                    <div class="col-6">
                        <select  id="parent" name="parent" class="custom-select">
                            <option value="">{{__("Parent")}}</option>
                            @foreach ($parentSubjectList as $parentSubject )

                            <option value="{{$parentSubject->id}}" {{($parentSubject->id == $subject->subject_id) ? 'selected':''}}>{{$parentSubject->name}}</option>
                            @foreach ($parentSubject->childSubjects as $subjectValue)
                            <option value="{{$subjectValue->id}}" {{($subjectValue->id == $subject->subject_id) ? 'selected':''}}>-{{$subjectValue->name}}</option>
                                @foreach ($subjectValue->childSubjects as $subSubjectLbl2)
                                <option value="{{$subSubjectLbl2->id}}" {{($subSubjectLbl2->id == $subject->subject_id) ? 'selected':''}}>--{{$subSubjectLbl2->name}}</option>
                                @endforeach
                            @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row content-center">
                    <button class="btn btn-pill btn-success " type="submit">{{__("Update")}}</button>
                </div>

            </form>
              </div>
      		</div>
      		<div class="card-footer">
      			<a class="btn btn-pill btn-primary" href="{{url()->previous()}}">{{__("Back")}}</a>
      		</div>

      	</div>
      </div>
  </div>
</div>
@endsection
