@extends('layouts.admin')

@section('content')
  <div class="container">
  	@include('layouts.parts.message')
    <div class="row justify-content-center">
      <div class="col-sm-12">
      	<div class="card">
      		<div class="card-header">
                  {{__('Showing Question Details')}}
      			<div class="card-header-actions">
              <a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.question.edit',$question->id)}}">{{__('Edit')}}</a>
            </div>
      		</div>
      		<div class="card-body">
                  {{__('Question')}} <br> {{$question->question}}
                  <br>
                  @foreach ($question->tags as $tag)
                  <span class="badge badge-pill badge-warning p-1 m-1 text-white">{{$tag->name}}</span>
                  @endforeach
                   <hr>
                  <div class="row">
                      <div class="col-md-6 my-3">
                        {{__('Option 1')}} :<br> {{$question->options[1]}}
                      </div>
                      <div class="col-md-6  my-3">
                        {{__('Option 2')}} :<br> {{$question->options[2]}}
                    </div>
                    <div class="col-md-6  my-3">
                        {{__('Option 3')}} :<br> {{$question->options[3]}}
                    </div>
                    <div class="col-md-6  my-3">
                        {{__('Option 4')}} :<br> {{$question->options[4]}}
                    </div>
                    <hr>
                  </div>
                  <div class="my-3">
                    {{__('Answer')}} : <br> {{$question->options[$question->answer]}}
                    </div>
                    <div class="row">
                        <div class="my-2 col-md-4">
                            {{__('Subject')}} : <br> {{$question->subject['name']}}
                        </div>
                        <div class="mu-2 col-md-4">
                            {{__('Point')}} : <br> {{$question->point}}
                        </div>
                        <div class="mu-2 col-md-4">
                            {{__('Difficulty')}} : <br> {{questionDifficultyH($question->difficulty)}}
                        </div>
                    </div>
                    @if ($question->help)
                        <div class="row">
                            <div class="card card-body shadow-sm">

                                    {!! $question->help !!}
                            </div>
                        </div>
                    @endif

      		</div>
      		<div class="card-footer">
      			<a class="btn btn-pill btn-sm btn-primary" href="{{url()->previous()}}">{{__('Back')}}</a>
      		</div>

      	</div>
      </div>
  </div>
</div>
@endsection
