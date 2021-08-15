@extends('layouts.admin')

@section('content')
  <div class="container-fluid">
  	@include('layouts.parts.message')
    <div class="row justify-content-center">
      <div class="col-sm-12">
      	<div class="card ">
      		<div class="card-header">
                 {{__('Exam')}} : <strong>{{$exam->name}}</strong>
      			<div class="card-header-actions">
                    <form action="{{ route('admin.exam.destroy',[$exam->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                    @if (empty($exam->status))
                    <a class="btn btn-primary btn-pill btn-sm" href="{{route('admin.exam.edit',$exam->id)}}">{{__('Edit')}}</a>
                    @endif
                    <a class="btn btn-primary btn-pill btn-sm" href="{{route('admin.exam.duplicate',$exam->id)}}">{{__('Duplicate')}}</a>
                    <button type="submit"  class="btn btn-pill btn-sm btn-danger" onclick="return confirm('Are you sure you want to Delete')">{{__('Delete')}}</button>
                    </form>
                </div>
      		</div>
      		<div class="card-body bg-gray">
                @include('admin.exam.crud._show-card-group')
                  <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="card">
                          <div class="card-body">
                            <div class="text-muted text-right mb-4">
                                <i class="c-icon c-icon-2xl fas fa-hourglass-half"></i>
                            </div>
                            <div class="text-value-lg">{{examStatusH($exam->status)}}</div><small class="text-muted text-uppercase font-weight-bold">{{__('Status')}}</small>
                            <div class="progress progress-xs mt-3 mb-0">
                              <div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-3">
                        <div class="card">
                          <div class="card-body">
                            <div class="text-muted text-right mb-4">
                                <i class="c-icon c-icon-2xl fas fa-minus-circle"></i>
                            </div>
                            <div class="text-value-lg">{{$exam->negative_mark/100}}</div><small class="text-muted text-uppercase font-weight-bold">{{__('Negative Marks Per Wrong Anser')}}</small>
                            <div class="progress progress-xs mt-3 mb-0">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-3">
                        <div class="card">
                          <div class="card-body">
                            <div class="text-muted text-right mb-4">
                                <i class="c-icon c-icon-2xl fas fa-file-alt"></i>
                            </div>
                            <div class="text-value-lg">{{examPublishResultJ($exam->publish_result)}}</div><small class="text-muted text-uppercase font-weight-bold">{{__('Publish Result?')}}</small>
                            <div class="progress progress-xs mt-3 mb-0">
                              <div class="progress-bar bg-warning" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-3">
                        <div class="card">
                          <div class="card-body">
                            <div class="text-muted text-right mb-4">
                                <i class="c-icon c-icon-2xl fas fa-random"></i>
                            </div>
                            <div class="text-value-lg">@if ($exam->randomise_questions){{__('Yes')}}@else{{__('No')}}@endif</div><small class="text-muted text-uppercase font-weight-bold">{{__('Random Questions?')}}</small>
                            <div class="progress progress-xs mt-3 mb-0">
                              <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
      		</div>
      		<div class="card-footer">
                <a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.exam.index')}}">{{__('Back')}}</a>
                <div class="card-header-actions">
                <a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.exam.status',$exam->id)}}">{{__('Change Status')}}</a>
                </div>
      		</div>

      	</div>
      </div>
  </div>
  <div class="row">
    <div class="col-sm-12 ">
        <div class="card content-center">
            <div class="card-header">
                 {{__('Documents')}}
            </div>
            <div class="card-body">
                        <!-- Button trigger modal -->
            <button type="button" class="btn btn-pill btn-primary" data-toggle="modal" data-target="#instructionModalLong">
                {{__("Instructions")}}
            </button>
            <button type="button" class="btn btn-pill btn-primary" data-toggle="modal" data-target="#descriptionModalLong">
                {{__("Description")}}
            </button>

                <!-- Modal -->
                <div class="modal fade" id="instructionModalLong" tabindex="-1" role="dialog" aria-labelledby="instructionModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="instructionModalLongTitle">{!! __("Instruction") !!}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            {!! $exam->instruction !!}
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-pill btn-secondary" data-dismiss="modal">{{__("Close")}}</button>
                        </div>
                    </div>
                    </div>
                </div>
                    <!-- Modal -->
                    <div class="modal fade" id="descriptionModalLong" tabindex="-1" role="dialog" aria-labelledby="descriptionModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="descriptionModalLongTitle">{!! __("Description") !!}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                {!! $exam->description !!}
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-pill btn-secondary" data-dismiss="modal">{{__("Close")}}</button>
                            </div>
                        </div>
                        </div>
                    </div>
            </div>
          </div>
    </div>
  </div>
  <div class="row ">
      <div class="col-md-12">
        <div class="card justify-content-center">
            <div class="card-header ">
              {{__('Questions')}}
              <div class="card-header-actions">
                  @if (empty($exam->status))
                  <a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.exam.questions',$exam->id)}}">{{__('Question Bank')}}</a>
                  @endif
            </div>
            </div>
            <div class="card-body">
                <table class="table table-responsive-sm table-hover table-outline mb-0">
                    <thead>
                      <tr>
                        <th>{{__('ID')}}</th>
                        <th>{{__('Question')}}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($questions as $question)
                      <tr>
                        <td>{{$question->id}}</td>
                        <td>{{\Str::limit($question->question, 70, '...')}}</td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="2">{{__('Sorry ! No Questions Found.')}}</td>
                      </tr>
                      @endforelse
                    </tbody>
                  </table>
                  <div class="row my-2  content-center">
                    {{$questions->links()}}
                </div>
            </div>
        </div>
      </div>

  </div>
</div>
@endsection
