@extends('layouts.user')
@section('content')
@include('layouts.parts.message')
<div class="row m-0">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">{{__('Result Analytics.')}}</div>
        <div class="card-body">
          <table class="table table-responsive-sm table-hover table-outline mb-0">
            <thead class="thead-light">
              <tr>
                <th class="text-center">
                  #
                </th>
                <th>{{__("Question")}}</th>
                <th class="text-center">{{__("Your Answer")}}</th>
                <th class="text-center">{{__("Time")}}</th>
                <th class="text-center">{{__("Action")}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($questions as $question)
                    @include('user.result.analytics.parts._td')
                @endforeach
            </tbody>
          </table>
        </div>
        <div class="m-2 content-center col-sm-12">
            {{$questions->links()}}
        </div>
      </div>
    </div>
    <!-- /.col-->
  </div>
@endsection
