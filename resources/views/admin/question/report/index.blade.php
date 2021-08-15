@extends('layouts.admin')
@section('styles')
@livewireStyles
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
@endsection

@section('content')
  <div class="container-fluid">
    @include('layouts.parts.message')
    <div class="row justify-content-center">
    @livewire('admin.question-reports')
  </div>
</div>

@endsection
@section('scripts')
@livewireScripts
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
