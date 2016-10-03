@extends('main')

@section('content')
	<div class="row">
		<div class=" col-md-12">

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
	</div>
@endsection
