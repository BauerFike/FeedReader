<nav class="navbar navbar-default navbar-static-top" role="navigation">
	<div class="container">
		<ul class="nav navbar-nav">
			<li><a href="/">Home</a></li>
			<li><a href="/feeds">Feeds</a></li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Articles<b class="caret"></b></a>
				<ul class="dropdown-menu">
					@foreach ($feeds as $feed)
						<li><a href="{{url('articles',$feed->id)}}">{{$feed->name}}</a></li>
					@endforeach
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="{{url('categories')}}">List</a></li>
					<li><a href="{{url('categories/create')}}">Insert</a></li>
					<li role="presentation" class="divider"></li>
					@foreach ($categories as $cat)
						<li><a href="{{url('articles/category',$cat->name)}}">{{$cat->name}}</a></li>
					@endforeach
				</ul>
			</li>
		</ul>
	</div>
</nav>
