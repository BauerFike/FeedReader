@extends('main')

@section('content')
	<div class="panel panel-default">
		<div class="panel-body">
			<a href="/categories/create" class="btn btn-primary pull-right">New category</a>
		</div>
	<div class="panel-body">
		@if (count($categories)>0)
			<ul class="list-group">
				@foreach ($categories as $key => $category)
					<li class="list-group-item">
						<a  class="" href="{{url('categories/'. $category->id.'/edit')}}">{{$category->name}}</a>
						<form  action="{{url('categories',$category->id)}}" method="post" class="pull-right">
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
			<div class="alert alert-info">
				There are no categories.
			</div>
		@endif
	</div>
@endsection
