@extends('main')

@section('content')

	@foreach ($articles as $k => $article)
		<div class="panel panel-default">
			<div class="panel-body article-panel">
				<div class="article-panel-content">
					<div class="article-title ">
						<a href="{{$article->link}}">{{$article->title}}</a>
					</div>
					<div class="metadata">
						<a href="{{$article->feed->htmlUrl}}">{{$article->feed->name}}</a> / <small class="">{{date("d-m-Y H:i",strtotime($article->pub_date))}}</small>
					</div>
					<article class="">
						@if ($article->image!="")
							<img src="{{$article->image}}" alt="" />
						@endif

						@if ($article->content!="")
							{!!$article->content!!}
						@else
							{!!$article->description!!}
						@endif
					</article>
				</div>
			</div>
		</div>

	@endforeach
	<nav aria-label="...">
		<ul class="pager">
			@if ($page<$npages)
				<li>
					<a href="{{url('articles',$page+1)}}">
						<span aria-hidden="true">&larr;</span>Older
					</a>
				</li>
			@endif
			@if ($page>0)
				<li>
					<a href="{{url('articles',$page-1)}}">
						Newer<span aria-hidden="true">&rarr;</span>
					</a>
				</li>
			@endif
		</ul>
	</nav>
@endsection
