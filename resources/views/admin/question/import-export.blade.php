@extends('layouts.admin')

@section('content')
  <div class="container">
  	@include('layouts.parts.message')
    <div class="row justify-content-center">
      <div class="col-sm-12">
      	<div class="card">
      		<div class="card-header">
      			{{__('Import Questions.')}}
      		</div>
      		<div class="card-body">
                <form action="{{route('admin.question.import')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h5>{{__('Please select the default values. It will be added if no value is present in you data file.')}}</h5>
                    </div>
                    <div class="col-sm-6">
                            <label for="subject" class="label label-required">{{__("Question Subject")}}</label>
                                <select id="subject_id" name="subject_id" class="subject select2 custom-select">
                                    @foreach ($subjectList as $parentSubject )
                                    <option value="{{$parentSubject->id}}">{{$parentSubject->name}}</option>
                                    @foreach ($parentSubject->childSubjects as $subjectValue)
                                    <option value="{{$subjectValue->id}}">-{{$subjectValue->name}}</option>
                                        @foreach ($subjectValue->childSubjects as $subSubjectLbl2)
                                        <option value="{{$subSubjectLbl2->id}}">--{{$subSubjectLbl2->name}}</option>
                                        @endforeach
                                    @endforeach
                                    @endforeach
                                </select>

                    </div>
                    <div class="col-sm-3">
                        <x-form.text-input label="Point" type='number' name="point" value="1" placeholder="{{__('Per Question Point')}}" addClass='form-control' required />
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group ">
                            <label for="difficulty" class="label label-required">{{__("Difficulty")}}</label>
                              <select id="difficulty" name="difficulty" class="custom-select">
                                <option value="1">{{__('Simple')}}</option>
                                <option value="2">{{__('Medium')}}</option>
                                <option value="3">{{__('Hard')}}</option>
                              </select>
                          </div>
                    </div>
                </div>
                   <hr>
                    <input type="file" name="import_questions" id="import_questions" required>
                <div class="my-2 content-center">
                <button type="submit" class="btn btn-pill btn-success ">{{__('Import')}}</button>
                </div>
            </form>
      		</div>
      		<div class="card-footer">
      			<a class="btn btn-pill btn-primary" href="{{url()->previous()}}">{{__("Back")}}</a>
      		</div>

      	</div>
      </div>

      <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                {{__('Export Questions')}}
            </div>
            <div class="card-body">
              <form action="{{route('admin.question.export')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="my-2 content-center">
              <button type="submit" class="btn btn-pill btn-success ">{{__('Export All Questions.')}}</button>
              </div>
          </form>
            </div>
            <div class="card-footer">
                <a class="btn btn-pill btn-primary" href="{{url()->previous()}}">{{__("Back")}}</a>
            </div>

        </div>
    </div>
  </div>
</div>
@endsection
