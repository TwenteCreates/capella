<?php
	include "db.php";
	session_start();
	$friends = DB::query("SELECT * FROM friends WHERE friend1=%s OR friend2=%s", $_GET["id"]);
	$me = $_GET["id"];
	if (!$me) {
		header("Location: ?id=1");
	}
?>
<!doctype html>
<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<link rel="apple-touch-icon" sizes="180x180" href="./apple-touch-icon.png?v=RyMwR3jE6k">
		<link rel="icon" type="image/png" sizes="32x32" href="./favicon-32x32.png?v=RyMwR3jE6k">
		<link rel="icon" type="image/png" sizes="194x194" href="./favicon-194x194.png?v=RyMwR3jE6k">
		<link rel="icon" type="image/png" sizes="192x192" href="./android-chrome-192x192.png?v=RyMwR3jE6k">
		<link rel="icon" type="image/png" sizes="16x16" href="./favicon-16x16.png?v=RyMwR3jE6k">
		<link rel="manifest" href="./manifest.json?v=RyMwR3jE6k">
		<link rel="mask-icon" href="./safari-pinned-tab.svg?v=RyMwR3jE6k" color="#ef394f">
		<link rel="shortcut icon" href="./favicon.ico?v=RyMwR3jE6k">
		<meta name="apple-mobile-web-app-title" content="Capella">
		<meta name="application-name" content="Capella">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="msapplication-TileImage" content="./mstile-144x144.png?v=RyMwR3jE6k">
		<meta name="theme-color" content="#292929">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
		<link rel="stylesheet" href="https://anandchowdhary.github.io/ionicons-3-cdn/icons.css" integrity="sha384-+iqgM+tGle5wS+uPwXzIjZS5v6VkqCUV7YQ/e/clzRHAxYbzpUJ+nldylmtBWCP0" crossorigin="anonymous">
		<link rel="stylesheet" href="default.css">

		<title>Capella</title>
		<meta name="description" content="...">
		<meta name="twitter:site" content="@AnandChowdhary">
		<link rel="author" href="//plus.google.com/+AnandChowdhary">
		<meta property="og:author" content="//facebook.com/AnandChowdhary">

		<script> var host="capella.tk"; host == window.location.host && "https:" != window.location.protocol && (window.location.protocol = "https"); </script>

	</head>

	<body>

		<a href="#content" class="sr-only sr-only-focusable">Skip to main content</a>

		<header id="masthead">
			<div class="title">Capella</div>
			<button onclick='emergency();' class="btn btn-outline-danger top-right-button"><i class="ion ion-ios-alert"></i></button>
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
						<a href="profile.php?id=<?php echo $me; ?>&user=<?php echo $friend["id"]; ?>">
							<img onclick="getUserLocation('<?php echo $friend["id"]; ?>');" alt="" src="<?php echo $friend["avatar"]; ?>" class="rounded-circle">
						</a>
						<div class="text-center mt-2"><?php echo $friend["name"]; ?></div>
					</div>
					<!-- <div class="col">
						<img onclick="$('.friend-card').slideToggle();" alt="" src="<?php echo $friend["avatar"]; ?>" class="rounded-circle">
						<div class="text-center mt-2"><?php echo $friend["name"]; ?></div>
					</div> -->
					<?php } ?>
					<div class="carousel-cell">
						<a href="people.php?id=1"><img onclick="getUserLocation('<?php echo $friend["id"]; ?>');" alt="" src="./images/plususer.png" class="rounded-circle"></a>
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
						<a href="people.php?id=<?php echo $_GET["id"]; ?>"><img alt="" src="./images/friends.png"></a>
						<div class="caption mt-2">People</div>
					</div>
					<div class="col">
						<a href="events.php?id=<?php echo $_GET["id"]; ?>"><img alt="" src="./images/events.png"></a>
						<div class="caption mt-2">Events</div>
					</div>
				</div>
			</section>
			<section>
				<h2 class="section-title">Explore</h2>
				<div class="row">
					<div class="col pr-0">
						<a href="taste.php?id=<?php echo $_GET["id"]; ?>"><img alt="" src="./images/music.png"></a>
						<div class="caption mt-2">Music Taste</div>
					</div>
					<div class="col">
						<a href="search.php?id=<?php echo $_GET["id"]; ?>"><img alt="" src="./images/singalong.png"></a>
						<div class="caption mt-2">SingAlong&trade;</div>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col pr-0">
						<a href="search.php?id=<?php echo $_GET["id"]; ?>"><img alt="" src="./images/search.png"></a>
						<div class="caption mt-2">Music Finder</div>
					</div>
					<div class="col">
						<a href="recommendations.php?id=<?php echo $_GET["id"]; ?>"><img alt="" src="./images/musicdiscovery.png"></a>
						<div class="caption mt-2">Recommendations</div>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col pr-0">
						<a href="popular.php?id=<?php echo $_GET["id"]; ?>"><img alt="" src="./images/map.png"></a>
						<div class="caption mt-2">Popular Venues</div>
					</div>
					<div class="col">
						&nbsp;
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

		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2" hidden>
			Launch demo modal
		</button>

		<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content bg-dark">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel2"><i class="ion ion-md-alert mr-2"></i>Emergency</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>Do you need immediate assistance? Select one of the options below:</p>
						<button class="btn btn-block btn-lg btn-secondary mr-2" data-dismiss="modal" onclick="<?php foreach ($friends as $friend) { if ($friend["id"] != $_GET["id"]) { echo "pingUser('" . $friend["id"] . "', 'emergency');"; } } ?>"><i class="ion ion-md-map mr-2"></i>Share Location with Friends</button>
						<a href="tel:112" target="_blank" class="btn btn-block btn-lg lookingMap btn-danger"><i class="ion ion-ios-call mr-2"></i>Call Emergency Services</a>
					</div>
				</div>
			</div>
		</div>

		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" hidden>
			Launch demo modal
		</button>

		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content bg-dark">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"><i class="ion ion-md-alert mr-2"></i><span class="lookingName"></span> is searching for you</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p><?php echo DB::queryFirstRow("SELECT name FROM users WHERE id=%s", $me)["name"]; ?>, your friend <span class="lookingName"></span> is looking for you. If you're lost, you can click on "Navigate" and we'll take you to <span class="lookingName"></span>.</p>
						<img alt="" class="lookingImg">
					</div>
					<div class="modal-footer">
						<a href="tel:+31644691056" class="btn btn-secondary mr-2" data-dismiss="modal"><i class="ion ion-ios-call mr-2"></i>Call</a>
						<a href="#" target="_blank" class="btn lookingMap btn-danger"><i class="ion ion-md-map mr-2"></i>Navigate</a>
					</div>
				</div>
			</div>
		</div>

		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/flickity@2.0.10/dist/flickity.pkgd.min.js"></script>
		<script>
			$(function() {
				if (navigator.geolocation) {
					function doFunction() {
						navigator.geolocation.getCurrentPosition(function(position) {
							var $cords = JSON.stringify([position.coords.latitude, position.coords.longitude]);
							$.post("savelocation.php", {
								cords: $cords,
								id: <?php echo $_GET["id"]; ?>
							}, function(response) {
								response = JSON.parse(response);
								if (response.isSomeoneLookingForMe == 1) {
									console.log(response);
									$('[data-target="#exampleModal"]').click();
									$(".lookingName").text(response.who_is_looking_name);
									$(".lookingImg").attr("src", "https://maps.googleapis.com/maps/api/staticmap?zoom=18&size=400x250&maptype=roadmap&markers=" + JSON.parse(response.location)[0] + "," + JSON.parse(response.location)[1] + "&key=AIzaSyCuiZevIb1G87KAoLRSECEdWNBQ06JCMjU");
									$(".lookingMap").attr("href", "http://maps.google.com/maps?f=d&daddr=" + (JSON.parse(response.location)[0]).toFixed(9) + "," + (JSON.parse(response.location)[1]).toFixed(9));
									window.navigator.vibrate(3000);
									if (response.need_help != null) {
										console.log("HELP MESSAGE");
										$(".lookingName").eq(1).parent().html('Your friend, ' + response.who_is_looking_name + ' needs your immediate assistance. Reach his location ASAP or contact him immediately.');
										$(".lookingName").first().parent().html('<i class="ion ion-md-alert mr-2"></i>' + response.who_is_looking_name + ' is in an emergency!');
									}
								} else {
									console.log("We're good to go");
								}
							})
						});
					}
					doFunction();
					setInterval(function() {
						doFunction();
					}, 5000);
				}
			});
			function pingUser(user, type) {
				if (!type) { type = null }
				$("#pingText").text("Pinging...");
				$("#pingText").css("opacity", 0.5);
				$.get("pingme.php?id=<?php echo $_GET["id"]; ?>&user=" + user + "&type=" + type, function() {
					$("#pingText").text("Ping");
					$("#pingText").css("opacity", 1);
				});
			}
			function emergency() {
			$('[data-target="#exampleModal2"]').click();
		}
		</script>

	</body>

</html>