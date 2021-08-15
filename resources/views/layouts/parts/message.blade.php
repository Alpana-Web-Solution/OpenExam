
<div class="row justify-content-center">
  <div class="col-sm-12">

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block" id="alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block" id="alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
        
</div>
@endif


@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block" id="alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('info'))
<div class="alert alert-info alert-block" id="alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<strong>{{ $message }}</strong>
</div>
@endif


@if ($errors->any())
<div class="alert alert-danger alert-block" id="alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	{{__('Please check the form below for errors.')}}
	@if($errors->count() > 0)
        <ul class="list list-unstyled">
	        @foreach($errors->all() as $error)
	            <li>{{ $error }}</li>
	        @endforeach
        </ul>
    @endif
</div>
@endif
  </div>
</div>

