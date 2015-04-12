@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10">
		<input type="hidden" id="count_element" name="count_element" value="{{ $count }}" />
		<h1>Gallery</h1>
			<div class="panel panel-default" id="container">
			@if(count($pictures) > 0)
				@foreach($pictures as $picture)
					<div class="col-md-4 container-item">
						@if($picture->picture_name)
							<img src="/uploads/thumbs/{{$picture->picture_name}}">
						@endif
					</div>
				@endforeach
			@else
			No images found.
			@endif
			</div>
		</div>
	</div>
</div>
@endsection