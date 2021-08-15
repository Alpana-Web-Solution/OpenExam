@extends('layouts.admin')
@section('styles')
@livewireStyles
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Create / Add a Subject') }}
                    <div class="card-header-actions">
                        <a class="btn btn-pill btn-primary btn-sm" href="{{route('admin.subject.index')}}">
                            {{__('Index')}}
                        </a>
                      </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @livewire('subject')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@livewireScripts
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function() {
    $('.parent').select2();
});
    window.addEventListener('alert', event => {
                 toastr[event.detail.type](event.detail.message,
                 event.detail.title ?? ''), toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                    }
                });
</script>
@endsection
