<div class="col-sm-6 col-lg-3 ">
    <div class="card shadow w-100 ">
      <div class="card-header bg-info text-white">
        <div class="text-value-lg">{{$exam->name}}</div>
        {{-- <div>{{\Str::limit($exam->description,70, ' ...')}}</div> --}}
        <div>{{__('Exam is ending')}} {{$exam->end_date->diffForHumans()}}</div>
        </div>
      <div class="card-body text-center">
        <div class="row">
            <div class="col ">
                <div class="text-value-xl">{{$exam->total_marks}}</div>
                <div class="text-uppercase text-muted small">{{__('Total')}}</div>
                <div class="text-uppercase text-muted small">{{__('Marks')}}</div>
              </div>
              <div class="c-vr"></div>
              <div class="col">
                <div class="text-value-xl"> {{round($exam->duration / 60,0) }}</div>
                <div class="text-uppercase text-muted small">{{__('Minutes')}}</div>
                <div class="text-uppercase text-muted small">{{__('Time Duration')}}</div>
              </div>
              @if(!empty($exam->negative_mark))
              <div class="c-vr"></div>
              <div class="col">
                <div class="text-value-xl">
                    {{$exam->negative_mark/100}}
                </div>
                <div class="text-uppercase text-muted small">{{__('Negative Mark')}}</div>
                <div class="text-uppercase text-muted small">{{__('Per Question')}}</div>
              </div>
              @endif
              <div class="c-vr"></div>
              <div class="col">
                <div class="text-value-xl">{{$exam->user_attended}}</div>
                <div class="text-uppercase text-muted small">{{__('Students')}}</div>
                <div class="text-uppercase text-muted small">{{__('Attended Exam')}}</div>
              </div>
        </div>

      </div>
      <div class="card-footer content-center">

          <div class="row my-3">
            <div class="btn-group">
                <small class="text-muted mr-1">
                    <a href="{{route('exam.instruction',$exam->id)}}" class="btn btn-pill btn-md btn-success">{{__('Attend')}}</a>
                </small>
                <small class="text-muted"><a href="{{route('exam.show',$exam->id)}}" class="btn btn-pill btn-md btn-success">{{__('Details')}}</a></small>
            </div>
              {{-- <div class="col-md-6 col-sm-6">
                <small class="text-muted"><a href="{{route('exam.instruction',$exam->id)}}" class="btn btn-md btn-success">{{__('Attend')}}</a></small>
              </div>
              <div class="col-md-6 col-sm-6">
            <small class="text-muted"><a href="{{route('exam.show',$exam->id)}}" class="btn btn-md btn-success">{{__('Details')}}</a></small>
              </div> --}}
          </div>
      </div>
    </div>
  </div>
