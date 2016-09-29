@extends('main')

@section('content')

	@foreach ($articles as $k => $article)
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">
					<div class="metadata">
						{{$article->feed->name}}<br>
						<small class="">{{date("d-m-Y H:i",strtotime($article->pub_date))}}</small>
					</div>
				</h3>
			</div>
			<div class="panel-body">
				<div class="article-title col-md-10 col-md-offset-1">
					{{$article->title}}
				</div>

				<article class="col-md-10 col-md-offset-1">
					<hr>

					@if (isset($article->image))
						<img src="{{$article->image->url}}" alt="{{$article->image->description}}" />
					@endif

					@if (isset($article->content))
						{!!$article->content!!}
					@else
						{!!$article->description!!}
					@endif
				</article>
			</div>
		</div>

	@endforeach

@endsection
