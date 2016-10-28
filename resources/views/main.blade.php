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
	<script type="text/javascript">
	jQuery(document).ready(function() {
		var page = 2;
		var loading = false;

		$(window).scroll(function () {
			if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10 && !loading) {
				loading = true;
				$.ajax({
					url: window.location.pathname+'?ajax=1&page='+page,
					dataType: 'html',
					// 	data: {param1: 'value1'}
				})
				.done(function(data) {
					loading = false;
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
		// $('body').keydown(function(e) {
		//     if (e.keycode === 74) {
		//         $(this)[0].scrollTop += 20;
		// 		$('html,body').animate({ scrollTop:$(this).parent().next().offset().top}, 'slow');});
		//     }
		//     else if (e.keycode === 75) {
		//         // how to scroll up?
		//         $(this)[0].scrollTop -= 20;
		//     }
		// }
	});

	</script>
</body>
</html>
