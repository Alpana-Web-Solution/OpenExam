@extends('layouts.app')

@section('content')
  <div class="container-fluid">
  	@include('layouts.parts.message')
      <div class="row content-center bg-light" style="padding: 3px;">
        @forelse($exams as $exam)
            @include('exam.parts._card',['exam'=>$exam])
        @empty
        <div class="col-sm-6 col-lg-3 ">
            <div class="card shadow w-100 ">
              <div class="card-header bg-info text-white">
                <div class="text-value-lg">
                    {{__("Sorry!")}}
                </div>
              </div>
              <div class="card-body">
                  {{__("No Exam Listed Here. We could not find any examination. Please come back soon.")}}

              </div>
            </div>
        </div>
        @endforelse
      </div>
      <div class="col">
        {{$exams->links()}}
    </div>
  </div>
</div>
@endsection
