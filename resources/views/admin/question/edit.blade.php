@extends('layouts.admin')

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
      			<form action="{{route('admin.question.update',$id)}}" method="POST" >
              @csrf
              @method('put')
              <div class="row">
                <div class="col-sm-6">
                        <label for="subject" class="label label-required">{{__("Question Subject")}}</label>
                            <select  id="subject" name="subject" class="subject select2 custom-select">
                                @foreach ($subjectList as $parentSubject )
                                <option value="{{$parentSubject->id}}"  {{($subject_id == $parentSubject->id) ? 'selected':''}}>{{$parentSubject->name}}</option>
                                @foreach ($parentSubject->childSubjects as $subjectValue)
                                <option value="{{$subjectValue->id}}" {{($subject_id == $subjectValue->id) ? 'selected':''}}>-{{$subjectValue->name}}</option>
                                    @foreach ($subjectValue->childSubjects as $subSubjectLbl2)
                                    <option value="{{$subSubjectLbl2->id}}" {{($subject_id == $subSubjectLbl2->id) ? 'selected':''}}>--{{$subSubjectLbl2->name}}</option>
                                    @endforeach
                                @endforeach
                                @endforeach
                                <option value="">{{__("No Subject")}}</option>
                            </select>

                </div>
                <div class="col-sm-3">
                    <x-form.text-input  value='{{$point}}' label="Point" type='number' name="point" placeholder="{{__('Per Question Point')}}" addClass='form-control' required />
                </div>
                <div class="col-sm-3">
                    <div class="form-group ">
                        <label for="difficulty" class="label label-required">{{__("Difficulty")}}</label>
                          <select wire:model.lazy='difficulty' id="difficulty" name="difficulty" class="custom-select">
                            <option value="1" {{($difficulty == 1) ? 'selected':''}}>{{__('Simple')}}</option>
                            <option value="2" {{($difficulty == 2) ? 'selected':''}}>{{__('Medium')}}</option>
                            <option value="3" {{($difficulty == 3) ? 'selected':''}}>{{__('Hard')}}</option>
                          </select>
                      </div>
                </div>
            </div>
            <hr>
              <x-form.text-input  value={{$question}} label="Question"  name="question" placeholder="{{__('Please input a Question')}}" addClass='form-control'  required error="$errors->first('question')"/>
                <div class="row">
                    <div class="col-md-6">
                        <x-form.text-input value={{$options[1]}} label="Option 1" name="options[1]" placeholder="{{__('Option')}}" addClass='form-control' required />
                    </div>
                    <div class="col-md-6">
                        <x-form.text-input value={{$options[2]}} label="Option 2" name="options[2]" placeholder="{{__('Option')}}" addClass='form-control' required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <x-form.text-input value={{$options[3]}} label="Option 3" name="options[3]" placeholder="{{__('Option')}}" addClass='form-control' required />
                    </div>
                    <div class="col-md-6">
                        <x-form.text-input value={{$options[4]}} label="Option 4" name="options[4]" placeholder="{{__('Option')}}" addClass='form-control' required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                    <div class="form-group ">
                        <label for="answer" class="label label-required">{{__("Answer")}}</label>
                          <select id="answer" name="answer" class="custom-select">
                            <option value="1"  {{($answer == 1) ? 'selected':''}}>{{__('Option 1')}}</option>
                            <option value="2"  {{($answer == 2) ? 'selected':''}}>{{__('Option 2')}}</option>
                            <option value="3"  {{($answer == 3) ? 'selected':''}}>{{__('Option 3')}}</option>
                            <option value="4"  {{($answer == 4) ? 'selected':''}}>{{__('Option 4')}}</option>
                          </select>
                      </div>
                    </div>
                </div>
                <div class="col-md-12 my-2">
                    <div class="form-group">
                        <label for="textarea">{{__('Help')}}</label>
                        <textarea
                        id="help" name="help"
                        placeholder="{{__("Leave it blank if you dont have an other details to provide")}} "
                        class="form-control @error('help') is-invalid  @enderror">
                        {{old('help', ($help ?? ''))}}
                    </textarea>
                      </div>
                    @error('help')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="my-2 content-center">
                    <button class="btn btn-pill btn-success" type="submit">{{__("Update")}}</button>
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
@section('scripts')

<script>
    ClassicEditor
    .create( document.querySelector( '#help' ) )
    .catch( error => {
        console.error( error );
    } );

</script>

@endsection
