@extends('main')

@section('content')
	<div class="row">
		<div class=" col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<a href="/feeds/create" class="btn btn-primary pull-right">New feed</a>
				</div>
				<div class="panel-body">
					@if (count($feeds)>0)
						<ul class="list-group">
							@foreach ($feeds as $key => $feed)
								<li class="list-group-item">
									<a class="col-md-6" href="{{$feed->htmlUrl}}">{{$feed->name}}</a>
									<a href="{{$feed->category->name}}">{{$feed->category->name}}</a>
									<form  action="{{url('feeds',$feed->id)}}" method="post" class="pull-right">
										<button type="submit" class="btn btn-xs " >
											Delete
										</button>
										{{csrf_field()}}
										{{method_field('DELETE')}}
									</form>
									<a  class="btn btn-xs pull-right" href="{{url('feeds/'. $feed->id.'/edit')}}"><button type="button" class="btn btn-xs">Edit</button></a>
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
