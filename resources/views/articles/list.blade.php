
@extends($isScrolling ? 'ajax' : 'main')

@section('content')
	@if (count($articles)==0)
		<div class="alert alert-warning">There are no articles.</div>
	@endif
	@foreach ($articles->getCollection()->all() as $k => $article)
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
	{{-- {{$articles->appends(Request::except('page'))->links()}} --}}
@endsection
