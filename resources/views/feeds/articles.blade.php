@extends('main')

@section('content')

	@foreach ($articles as $k => $article)
		<div class="panel panel-default">
			<div class="panel-body article-panel">
				<div class="article-panel-content">
					<div class="article-title ">
						{{$article->title}}
					</div>
					<div class="metadata">
						{{$article->feed->name}} / <small class="">{{date("d-m-Y H:i",strtotime($article->pub_date))}}</small>
					</div>
					<article class="">
						@if ($article->image!="")
							<img src="{{$article->image}}" alt="" />
						@endif

						@if (isset($article->content))
							{!!$article->content!!}
						@else
							{!!$article->description!!}
						@endif
					</article>
				</div>
			</div>
		</div>

	@endforeach

@endsection
