@extends('layouts.admin')

@section('content')
  <div class="container-fluid">
  	@include('layouts.parts.message')
    <div class="row justify-content-center">
      <div class="col-sm-12">
      	<div class="card">
      		<div class="card-header">
                  {{__('Exam Results.')}}
      			<div class="card-header-actions">
                    <a class="btn btn-pill btn-sm btn-primary" href="{{route('admin.exam.result.export',$exam->id)}}">{{__("Download")}}</a>
                </div>
      		</div>
      		<div class="card-body">
                <div class="row">

                <table class="table table-responsive-sm table-hover table-outline mb-0">
                    <thead class="thead-light">
                    <tr>
                        <th class="text-center">
                            <i class="fas fa-users"></i>
                        </th>
                        <th>{{__('User')}}</th>
                        <th>{{__("Percentage")}}</th>
                        <th>{{__("Activity")}}</th>
                        <th>{{__("Actions")}}</th>
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
                                    <img class="c-avatar-img" src="https://res.cloudinary.com/debjit/image/upload/v1508259244/computer-icon-2429310_640_vjicij.png" alt="{{$result->user->email}}">
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
                                <div class="float-right"><small class="text-muted">{{$result->created_at->toTimeString('minute')}} - {{$result->finish_time->toTimeString('minute')}}</small></div>
                            </div>
                            <div class="progress progress-xs">
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{$result->percentage}}%" aria-valuenow="{{$result->percentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            </td>

                            <td>
                            <div class="small text-muted">{{__("Last Attempt")}}</div>
                            <strong>{{$result->created_at->diffForHumans()}}</strong>
                            </td>
                            <td>
                                <a href="{{route('admin.exam.result.analytics',[$exam->id,$result->id])}}">{{__("Analytics")}}</a>

                            </td>
                        </tr>
                        @empty

                        @endforelse

                    </tbody>
                </table>

                  <div class="row content-center">
                      <div class="col">
                          {{-- {{$results->links()}} --}}

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
