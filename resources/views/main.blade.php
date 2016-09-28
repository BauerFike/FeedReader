<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>FeedReader</title>

	<link rel="stylesheet" href="/css/app.css" media="screen" title="no title">
	<script src="/js/app.js" charset="utf-8"></script>
</head>
<body>

	<nav class="navbar navbar-default navbar-static-top" role="navigation">
		<div class="container">
			<ul class="nav navbar-nav">
				<li><a href="/feeds">Feeds</a></li>
			</ul>
		</div>
	</nav>
	<div class="container">
		<div class="content">
			@yield('content')
		</div>
	</div>
</body>
</html>
