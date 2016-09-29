@extends('main')

@section('content')

	@foreach ($articles as $k => $article)
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">{{$article->title}} <small>{{$article->pub_date}}</small></h3>
		  </div>
		  <div class="panel-body">
				<article class="">

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
