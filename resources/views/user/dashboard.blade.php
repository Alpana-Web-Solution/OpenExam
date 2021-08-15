@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Welcome!') }}
                    <p>{{__('You have currently given ') }} {{$resultCount}} {{__("Exams.")}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
