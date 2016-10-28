<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">Feedreader</a>
		</div>
		<ul class="nav navbar-nav">
			<li><a href="/">Home</a></li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Feeds<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="/feeds">List</a></li>
					<li role="presentation" class="divider"></li>
					@foreach ($feeds as $feed)
						<li><a href="{{url('articles',$feed->id)}}">{{$feed->name}}</a></li>
					@endforeach
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="{{url('categories')}}">List</a></li>
					<li role="presentation" class="divider"></li>
					@foreach ($categories as $cat)
						<li><a href="{{url('articles/category',$cat->name)}}">{{$cat->name}}</a></li>
					@endforeach
				</ul>
			</li>
		</ul>
	</div>
</nav>
