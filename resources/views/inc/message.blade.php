@if(count($errors) > 0)
	@foreach($errors->all() as $error)
		<div class="alert alert-danger">
			{{$error}}
		</div>
	@endforeach
@endif

@if(session('status'))
	<div class="alert alert-success">
		<div class='container'>
			{{ session('status') }}
		</div>
	</div>
@endif

@if(session('error'))
	<div class="alert alert-danger">
		<div class='container'>
			{{ session('error') }}
		</div>
	</div>
@endif