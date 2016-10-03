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
	<div class="container">
		<div class="content">
			@yield('content')
		</div>
	</div>
	<script src="/js/app.js" charset="utf-8"></script>
	<script type="text/javascript">
	jQuery(document).ready(function() {
		var page = 0;
		$(window).scroll(function () {
			if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10) {
				$.ajax({
					url: '/articles/category/Science?ajax=1page='+page,
					dataType: 'html',
					// 	data: {param1: 'value1'}
				})
				.done(function(data) {
					console.log("success");
					page+=1;
					$('.content').append(data);
				});
				// .fail(function() {
				// 	console.log("error");
				// })
				// .always(function() {
				// 	console.log("complete");
				// });

			}
		});
	});
	</script>
</body>
</html>
