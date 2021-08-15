@extends('layouts.admin')
@section('styles')
<style>
    .ck-editor__editable_inline {
        min-height: 150px;
    }
</style>
@livewireStyles
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Create / Add a Question.') }}
                    <div class="card-header-actions">
                        <a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.question.index')}}">{{__('Index')}}</a>
                      </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @livewire('admin.question-create')

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@livewireScripts
@stack('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    window.addEventListener('alert', event => {
                 toastr[event.detail.type](event.detail.message,
                 event.detail.title ?? ''), toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                    }
                });
</script>
@endsection
