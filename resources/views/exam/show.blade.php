@extends('layouts.app')

@section('content')
  <div class="container-fluid">
  	@include('layouts.parts.message')
    <div class="row justify-content-center">
      <div class="col-sm-12">
      	<div class="card text-white bg-info">
      		<div class="card-body">
                <div class="text-value-lg">{{$exam->name}}</div>
      		</div>
      		<div class="card-footer">
      			<a class="btn btn-pill btn-primary" href="{{route('exam.index')}}">{{__('Back')}}</a>
                  <div class="card-header-actions">
                    <a class="btn btn-pill btn-success" href="{{route('exam.instruction',$exam->id)}}">{{__('Attend')}}</a>
                  </div>
      		</div>

      	</div>
          @include('exam.parts._show-card-group')
          <div class="card card-body shadow-sm">
            <h4>{{__('Description')}}</h4>
          {!! $exam->description !!}
        </div>
        <div class="card card-body shadow-sm">
            <div class="content-center">
                <h3><i class="fa fa-trophy" aria-hidden="true"></i> {{__('Leaderboard')}} <i class="fa fa-trophy" aria-hidden="true"></i></h3>

            </div>
            @if ($exam->publish_result == 2 AND !$exam->end_date->isPast())
            {{__('Leaderboard will be visible after exam finished.')}}
            @else
            <table class="table table-responsive-sm table-hover table-outline m-0">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center">
                            <i class="fas fa-users"></i>
                        </th>
                        <th>{{__('User')}}</th>
                        <th>{{__("Percentage")}}</th>
                        <th>{{__("Activity")}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($results as $result)
                <tr>
                    <td class="text-center">
                        @if ($result->user->avatar)
                        <div class="c-avatar">
                            <img class="c-avatar-img" src="{{asset($result->user->avatar)}}" alt="{{$result->user->email}}">
                            <span class="c-avatar-status bg-success"></span>
                        </div>
                        @else
                        <div class="c-avatar">
                            <img class="c-avatar-img" src="https://res.cloudinary.com/debjit/image/upload/v1598972041/149_50_logo_uas3uf.png" alt="{{$result->user->email}}">
                            <span class="c-avatar-status bg-success"></span>
                        </div>
                        @endif
                        </td>
                        <td>
                        <div>{{$result->user->name}}</div>
                        <div class="small text-muted"><span>{{__('Completed on')}}</span> | {{$result->finish_time->isoFormat('lll')}}</div>
                        </td>

                        <td>
                        <div class="clearfix">
                            <div class="float-left"><strong>{{$result->percentage}}%</strong></div>

                        </div>
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-info" role="progressbar" style="width: {{$result->percentage}}%" aria-valuenow="{{$result->percentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        </td>

                        <td>
                        <div class="small text-muted">{{__("Last Attempt")}}</div><strong>{{$result->created_at->diffForHumans()}}</strong>
                        </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4"  class="text-center">
                            {{__("Be the first to attend this exam.")}}
                    </td>
                </tr>

                @endforelse

                </tbody>
            </table>

            @endif

          </div>


      </div>
  </div>
</div>
@endsection
