@if(Session::has('success_message'))
<div class="alert border-0 border-success border-start border-4 bg-success-subtle alert-dismissible fade show">
	<div class="text-success">{!! Session::get('success_message')!!}</div>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(Session::has('error_message'))
<div class="alert border-0 border-danger border-start border-4 bg-danger-subtle alert-dismissible fade show">
	<div class="text-danger">{!! Session::get('error_message')!!}</div>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(isset($errors) && !empty($errors) && count($errors) > 0)
<div class="row">
	<div class="col-md-12 col-sm-6 col-xs-12">
		<div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show" role="alert">
			<button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
			@foreach ($errors->all() as $message)
			<p><i class="icon fa fa-check"></i>
				{{ $message }}
			</p>
			@endforeach
		</div>
	</div>
</div>
@endif