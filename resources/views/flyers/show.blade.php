@extends('layout')

@section('content')

	<div class="row">
		<div class="col-md-3">
			<h1>{{ $flyer->street }}</h1>
			<h2>{!! $flyer->price !!}</h2>
			
			<hr>

			<div class="description">
				{!! nl2br($flyer->description) !!}
			</div>
		</div>
		<div class="col-md-9">
			@foreach( $flyer->photos as $photo)
				<img src="{{ $photo->path }}" alt="">
			@endforeach
		</div>
	</div>

	<hr>

	<h2>Add your photos</h2>
	<form 
		method="post" 
		id="addPhotosForm" 
		action="/{{ $flyer->zip }}/{{ $flyer->street }}/photos" 
		class="dropzone"
	>
		{{ csrf_field() }}
	</form>
@stop


@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.js"></script>
  <script>
  	Dropzone.options.addPhotosForm = {
  		paramName : 'photo',
  		maxFilesize: 3,
  		acceptedFiles: '.jpg, .jpeg, .png, .gif, bmp',
  	};
  </script>
@stop