<?php
	include "db.php";
	session_start();
	$friends = DB::query("SELECT * FROM users");
?>
<!doctype html>
<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<meta name="theme-color" content="#eee">
		<link rel="shortcut icon" href="/icon/favicon.ico">
		<link rel="icon" type="image/png" href="/icon/favicon-32x32.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/icon/apple-touch-icon-180x180.png">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous" media="none" onload="if (media != 'all') media = 'all'">
		<link rel="stylesheet" href="https://anandchowdhary.github.io/ionicons-3-cdn/icons.css" integrity="sha384-+iqgM+tGle5wS+uPwXzIjZS5v6VkqCUV7YQ/e/clzRHAxYbzpUJ+nldylmtBWCP0" crossorigin="anonymous" media="none" onload="if (media != 'all') media = 'all'">
		<link rel="stylesheet" href="default.css" media="none" onload="if (media != 'all') media = 'all'">
		<link rel="stylesheet" href="https://unpkg.com/flickity@2.0.10/dist/flickity.css">
		<noscript>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
			<link rel="stylesheet" href="https://anandchowdhary.github.io/ionicons-3-cdn/icons.css" integrity="sha384-+iqgM+tGle5wS+uPwXzIjZS5v6VkqCUV7YQ/e/clzRHAxYbzpUJ+nldylmtBWCP0" crossorigin="anonymous">
			<link rel="stylesheet" href="default.css">
		</noscript>

		<title>Amplify</title>
		<meta name="description" content="...">
		<meta name="twitter:site" content="@AnandChowdhary">
		<link rel="author" href="//plus.google.com/+AnandChowdhary">
		<meta property="og:author" content="//facebook.com/AnandChowdhary">

		<script> var host="DOMAIN"; host == window.location.host && "https:" != window.location.protocol && (window.location.protocol = "https"); </script>

	</head>

	<body>

		<a href="#content" class="sr-only sr-only-focusable">Skip to main content</a>

		<header id="masthead">
			<div class="title">Amplify</div>
		</header>

		<main id="content">
			<section>
				<h2 class="section-title">Friends</h2>
				<div class="main-carousel" data-flickity='{ "cellAlign": "left", "contain": true }'>
					<?php foreach ($friends as $friend) { ?>
					<div class="carousel-cell">
						<img onclick="getUserLocation('<?php echo $friend["id"]; ?>');" alt="" src="<?php echo $friend["avatar"]; ?>" class="rounded-circle">
						<div class="text-center mt-2"><?php echo $friend["name"]; ?></div>
					</div>
					<?php } ?>
				</div>
			</section>
			<section>
				<h2 class="section-title">Discover</h2>
				<div class="row">
					<div class="col">1</div>
					<div class="col">1</div>
				</div>
			</section>
		</main>

		<footer id="colophon">
			<div class="container-fluid">
				<div class="row">
					<div class="col active">
						<i class="ion ion-ios-home"></i>
						<div class="label">Home</div>
					</div>
					<div class="col">
						<i class="ion ion-ios-star"></i>
						<div class="label">Discover</div>
					</div>
					<div class="col">
						<i class="ion ion-ios-calendar"></i>
						<div class="label">Events</div>
					</div>
					<div class="col">
						<i class="ion ion-ios-person"></i>
						<div class="label">Profile</div>
					</div>
					<div class="col">
						<i class="ion ion-ios-settings"></i>
						<div class="label">Settings</div>
					</div>
				</div>
			</div>
		</footer>

		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/flickity@2.0.10/dist/flickity.pkgd.min.js"></script>
		<script>
			function getUserLocation(id) {
				$.get("poll.php?id=" + id, function(data) {
					console.log(data);
				});
			}
		</script>

	</body>

</html>