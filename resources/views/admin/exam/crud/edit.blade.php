@extends('layouts.admin')

@section('content')
  <div class="container">
  	@include('layouts.parts.message')
    <div class="row justify-content-center">
      <div class="col-sm-12">
      	<div class="card">
      		<div class="card-header">
      			{{__("Edit")}}
      		</div>
      		<div class="card-body">
      			<form action="{{route('admin.exam.update', $id)}}" method="POST" >
              @csrf
              @method('put')

                    @include('admin.exam.crud.form')
              <button class="btn btn-pill btn-success" type="submit">{{__("Update")}}</button>
            </form>
      		</div>
      		<div class="card-footer">
      			<a class="btn btn-pill btn-primary" href="{{url()->previous()}}">{{__("Back")}}</a>
      		</div>

      	</div>
      </div>
  </div>
</div>
@endsection
@section('scripts')
@section('scripts')
<script>
$('.datetime').datetimepicker({
    format: 'YYYY-MM-DD HH:mm:ss',
    locale: 'en',
    // inline: true,
    sideBySide: true,
    icons: {
      up: 'fas fa-chevron-up',
      down: 'fas fa-chevron-down',
      previous: 'fas fa-chevron-left',
      next: 'fas fa-chevron-right'
    }
  });

  $("#start_date").on("dp.change", function (e) {
           $('#end_date').data("DateTimePicker").minDate(e.date);
       });
       $("#end_date").on("dp.change", function (e) {
           $('#start_date').data("DateTimePicker").maxDate(e.date);
       });

ClassicEditor
    .create( document.querySelector( '#description' ) )
    .catch( error => {
        console.error( error );
    } );
    ClassicEditor
    .create( document.querySelector( '#instruction' ) )
    .catch( error => {
        console.error( error );
    } );
</script>
@endsection
