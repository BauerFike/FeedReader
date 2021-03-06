<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>FeedReader</title>
	<link rel="stylesheet" href="/css/app.css" media="screen" title="no title">
</head>
<body>
	@include('components.navbar')
	<div class="container bodycontent">
		<div class="content">
			@yield('content')
		</div>
	</div>
	<script src="/js/app.js" charset="utf-8"></script>
	@yield('scripts')
</body>
</html>
