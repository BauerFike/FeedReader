@extends('main')
@section('content')
	<div class="row">
		<div class=" col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Insert Category</h3>
				</div>
				<div class="panel-body">
					<form class="" action="{{url('/categories')}}" method="post">
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
						<button class="btn btn-primary" type="submit" name="submit">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
