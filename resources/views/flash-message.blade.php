@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="btn-close" data-bs-dismiss="alert"></button>	
        <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
	<button type="button" class="btn-close" data-bs-dismiss="alert"></button>	
        <strong>{{ $message }}</strong>
</div>
@endif