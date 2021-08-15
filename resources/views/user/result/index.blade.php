@extends('layouts.user')

@section('content')
  <div class="container-fluid">
  	@include('layouts.parts.message')
    <div class="row justify-content-center">
      <div class="col-sm-12">
      	<div class="card">
      		<div class="card-header">
                  {{__('Your Previous Exam Results.')}}
      			<div class="card-header-actions">
                </div>
      		</div>
      		<div class="card-body">
                <div class="row">

                  <table class="table table-responsive-sm table-hover table-outline mb-0">
                    <thead class="thead-light">
                      <tr>
                        <th>{{__('Exam Name')}}</th>
                        <th>{{__('Percentage')}}</th>
                        <th>{{__('Analytics')}}</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($results as $result)
                      <tr>
                        <td>
                          <div><a href="{{route('exam.show',$result->exam->id)}}">{{$result->exam->name}}</a></div>
                          <div class="small text-muted"><span>{{__('Completed on')}}</span> | {{\Carbon\Carbon::parse($result->finish_time)->isoFormat('lll')}}</div>
                        </td>
                        @if($result->exam->publish_result == 2)
                                @if (!$result->exam->end_date->isPast())
                                <td colspan="2">
                                    {{__('You can check your result after exam has ended.')}}
                                </td>
                                @else
                                <td>
                                    <div class="clearfix">
                                        <div class="float-left"><strong>{{$result->percentage}}%</strong></div>
                                      </div>
                                      <div class="progress progress-xs">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{$result->percentage}}%" aria-valuenow="{{$result->percentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{route('user.result.analytics',$result->id)}}">{{__('Analytics')}}</a>
                                </td>
                                @endif
                        @else
                        <td>
                            <div class="clearfix">
                                <div class="float-left"><strong>{{$result->percentage}}%</strong></div>
                              </div>
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{$result->percentage}}%" aria-valuenow="{{$result->percentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </td>
                        <td>
                            <a href="{{route('user.result.analytics',$result->id)}}">{{__('Analytics')}}</a>
                        </td>
                        @endif
                      </tr>
                      @empty

                      @endforelse

                    </tbody>
                  </table>

                  <div class="row content-center">
                      <div class="col">
                          {{$results->links()}}

                      </div>

                  </div>
                </div>

      		</div>
      		<div class="card-footer">
      			<a class="btn btn-pill btn-primary" href="{{url()->previous()}}">{{__('Back')}}</a>
      		</div>

      	</div>
      </div>
  </div>
</div>
@endsection
