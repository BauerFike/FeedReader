@extends('main')

@section('content')
	<div class="row">
		<div class=" col-md-6">

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Insert Feed</h3>
				</div>
				<div class="panel-body">

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
				</div>
			</div>
		</div>
		<div class="col-md-6">

			<div class="panel panel-default ">
				<div class="panel-heading">
					<h3 class="panel-title">Feeds</h3>
				</div>
				<div class="panel-body">

					@if (count($feeds)>0)

						<ul class="list-group">
							@foreach ($feeds as $key => $feed)
								<li class="list-group-item">
									<a href="{{$feed->htmlUrl}}">{{$feed->name}}</a>
									<form  action="{{url('feeds',$feed->id)}}" method="post" class="pull-right">
										<button type="submit" class="btn btn-xs " >
											Delete
										</button>
										{{csrf_field()}}
										{{method_field('DELETE')}}
									</form>
								</li>
							@endforeach
						</ul>
					@else
						<div class="alert-info">
							There are no feeds.
						</div>
					@endif
				</div>
			</div>
		</div>

	</div>
@endsection
