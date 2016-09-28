@extends('main')

@section('content')
	<div class="row">

		<form class="" action="{{url('/feeds')}}" method="post">
			{{csrf_field()}}
			<div class="form-group">
				<label for="name">Name</label>
				@foreach ($errors->get('name') as $err)
					<div class="alert alert-danger">
						{{$err}}
					</div>
				@endforeach
				<input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{old('name')}}">
			</div>
			<div class="form-group">
				<label for="xmlUrl">Xml url</label>
				@foreach ($errors->get('xmlUrl') as $err)
					<div class="alert alert-danger">
						{{$err}}
					</div>
				@endforeach
				<input type="text" class="form-control" id="xmlUrl" name="xmlUrl" placeholder="Xml url" value="{{old('xmlUrl')}}">
			</div>
			<div class="form-group">
				<label for="htmlUrl">Html url</label>
				<input type="text" class="form-control" id="htmlUrl" name="htmlUrl" placeholder="Html url" value="{{old('htmlUrl')}}">
			</div>
			<button class="btn btn-primary" type="submit" name="submit">Submit</button>
		</form>
		<hr>
		@if (count($feeds)>0)

			<ul class="list-group">
				@foreach ($feeds as $key => $feed)
					<li class="list-group-item"><a href="{{$feed->htmlUrl}}">{{$feed->name}}</a></li>
				@endforeach
			</ul>
		@else
			<div class="alert-info">
				There are no feeds.
			</div>
		@endif
	</div>
@endsection
