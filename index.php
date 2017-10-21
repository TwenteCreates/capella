<?php
	include "db.php";
	session_start();
	$friends = DB::query("SELECT * FROM friends WHERE friend1=%s OR friend2=%s", $_GET["id"]);
	$me = $_GET["id"];
?>
<!doctype html>
<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<link rel="apple-touch-icon" sizes="180x180" href="./apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="./favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="./favicon-16x16.png">
		<link rel="manifest" href="./manifest.json">
		<link rel="mask-icon" href="./safari-pinned-tab.svg" color="#ea4554">
		<meta name="theme-color" content="#292929">		

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
		<link rel="stylesheet" href="https://anandchowdhary.github.io/ionicons-3-cdn/icons.css" integrity="sha384-+iqgM+tGle5wS+uPwXzIjZS5v6VkqCUV7YQ/e/clzRHAxYbzpUJ+nldylmtBWCP0" crossorigin="anonymous">
		<link rel="stylesheet" href="default.css">

		<title>Capella</title>
		<meta name="description" content="...">
		<meta name="twitter:site" content="@AnandChowdhary">
		<link rel="author" href="//plus.google.com/+AnandChowdhary">
		<meta property="og:author" content="//facebook.com/AnandChowdhary">

		<script> var host="DOMAIN"; host == window.location.host && "https:" != window.location.protocol && (window.location.protocol = "https"); </script>

	</head>

	<body>

		<a href="#content" class="sr-only sr-only-focusable">Skip to main content</a>

		<header id="masthead">
			<div class="title">Capella</div>
			<button class="btn btn-outline-danger top-right-button"><i class="ion ion-ios-alert"></i></button>
		</header>

		<main id="content">
			<section>
				<h2 class="section-title">Friends</h2>
				<div class="main-carousel" data-flickity='{ "cellAlign": "left", "contain": true }'>
				<!-- <div class="row"> -->
					<?php foreach ($friends as $friend1) {
						$m1 = "friend1";
						if ($friend1["friend1"] == $me) { $m1 = "friend2"; }
						$friend = DB::queryFirstRow("SELECT * FROM users WHERE id=%s", $friend1[$m1]); ?>
					<div class="carousel-cell">
						<img onclick="getUserLocation('<?php echo $friend["id"]; ?>');" alt="" src="<?php echo $friend["avatar"]; ?>" class="rounded-circle">
						<div class="text-center mt-2"><?php echo $friend["name"]; ?></div>
					</div>
					<!-- <div class="col">
						<img onclick="$('.friend-card').slideToggle();" alt="" src="<?php echo $friend["avatar"]; ?>" class="rounded-circle">
						<div class="text-center mt-2"><?php echo $friend["name"]; ?></div>
					</div> -->
					<?php } ?>
					<div class="carousel-cell">
						<img onclick="getUserLocation('<?php echo $friend["id"]; ?>');" alt="" src="./images/plususer.png" class="rounded-circle">
						<div class="text-center mt-2">Discover</div>
					</div>
				</div>
				<!-- <div class="card text-white bg-dark friend-card mt-3">
					<div class="card-header"><i class="ion ion-ios-pin mr-2"></i>Paula's Live Location</div>
					<div class="card-body">
						<img class="mb-3" alt="" src="https://maps.googleapis.com/maps/api/staticmap?zoom=18&size=400x250&maptype=roadmap&markers=52.4014634,4.8932525&key=AIzaSyCuiZevIb1G87KAoLRSECEdWNBQ06JCMjU">
						<button class="btn btn-primary mr-1"><i class="ion ion-ios-notifications mr-2"></i>Ping</button>
						<button class="btn btn-secondary mr-1"><i class="ion ion-ios-call mr-2"></i>Call</button>
						<button class="btn btn-secondary"><i class="ion ion-md-volume-up mr-2"></i>Ring</button>
						<p class="text-muted small mt-3 mb-0">By pinging Paula, you'll vibrate her phone and share your location with her.</p>
					</div>
				</div> -->
			</section>
			<section>
				<h2 class="section-title">Discover</h2>
				<div class="row">
					<div class="col pr-0">
						<img alt="" src="./images/friends.png">
						<div class="caption mt-2">People</div>
					</div>
					<div class="col">
						<img alt="" src="./images/events.png">
						<div class="caption mt-2">Events</div>
					</div>
				</div>
			</section>
			<section>
				<h2 class="section-title">Explore</h2>
				<div class="row">
					<div class="col pr-0">
						<img alt="" src="./images/music.png">
						<div class="caption mt-2">Music Taste</div>
					</div>
					<div class="col">
						<img alt="" src="./images/singalong.png">
						<div class="caption mt-2">SingAlong&trade;</div>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col pr-0">
						<img alt="" src="./images/search.png">
						<div class="caption mt-2">Music Finder</div>
					</div>
					<div class="col">
						<img alt="" src="./images/musicdiscovery.png">
						<div class="caption mt-2">Recommendations</div>
					</div>
				</div>
			</section>
		</main>

		<footer id="colophon">
			<div class="container-fluid">
				<div class="row">
					<a href="./?id=<?php echo $_GET["id"]; ?>" class="col active">
						<i class="ion ion-ios-home"></i>
						<div class="label">Home</div>
					</a>
					<a href="./taste.php?id=<?php echo $_GET["id"]; ?>" class="col">
						<i class="ion ion-ios-musical-notes"></i>
						<div class="label">Taste</div>
					</a>
					<a href="./search.php?id=<?php echo $_GET["id"]; ?>" class="col">
						<i class="ion ion-ios-search"></i>
						<div class="label">Search</div>
					</a>
					<a href="./people.php?id=<?php echo $_GET["id"]; ?>" class="col">
						<i class="ion ion-ios-people"></i>
						<div class="label">People</div>
					</a>
					<a href="./settings.php?id=<?php echo $_GET["id"]; ?>" class="col">
						<i class="ion ion-ios-settings"></i>
						<div class="label">Settings</div>
					</a>
				</div>
			</div>
		</footer>

		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/flickity@2.0.10/dist/flickity.pkgd.min.js"></script>
		<script>
			$(function() {
				if (navigator.geolocation) {
					setInterval(function() {
						navigator.geolocation.getCurrentPosition(function(position) {
							var $cords = JSON.stringify([position.coords.latitude, position.coords.longitude]);
							// console.log($cords);
							$.post("savelocation.php", {
								cords: $cords,
								id: <?php echo $_GET["id"]; ?>
							}, function(response) {
								if (response == 1) {
									window.navigator.vibrate(3000);
									alert("Anand is looking for you!");
								} else {
									console.log("We're good to go");
								}
							})
						});
					}, 10000);
				}
			});
		</script>

	</body>

</html>