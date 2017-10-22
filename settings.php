<?php
	include "db.php";
	session_start();
	$me = $_GET["id"];
	$profi = DB::queryFirstRow("SELECT * FROM users WHERE id=%s", $_GET["id"]);
	$friends = DB::query("SELECT * FROM friends WHERE friend1=%s OR friend2=%s", $_GET["id"]);
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

		<link rel="stylesheet" href="https://unpkg.com/flickity@2.0.10/dist/flickity.css">
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
			<div class="title">Settings</div>
			<button onclick='emergency();' class="btn btn-outline-danger top-right-button"><i class="ion ion-ios-alert"></i></button>
		</header>

		<main id="content">
			<section>
				<div class="row p-3">
					<div class="col-4">
						<img alt="" src="<?php echo $profi["avatar"]; ?>" class="rounded-circle">
					</div>
					<div class="col">
						<div><strong><?php echo $profi["name"]; ?></strong></div>
						<div><span><?php echo $profi["tel"]; ?></span></div>
						<div><button class="btn btn-danger mt-2" data-toggle="modal" data-target="#exampleModal3">View QR Code</button></div>
						
					</div>
				</div>
			</section>
			<section>
				<h2 class="section-title">Your Friends</h2>
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
					<?php } ?>
				</div>
			</section>
			<section class="mt-4">
				<h2 class="section-title">Your Favorite Genres</h2>
				<div class="main-carousel" data-flickity='{ "cellAlign": "left", "contain": true }'>
				<!-- <div class="row"> -->
					<?php $a = DB::query("SELECT DISTINCT genre FROM likes WHERE who_likes=%s", $_GET["id"]);
						foreach ($a as $genre) { ?>
					<div class="carousel-cell">
						<img alt="" src="https://tse2.mm.bing.net/th?q=<?php echo $genre["genre"]; ?>&w=70&h=70&c=7&rs=1&p=0&dpr=3&pid=1.7&mkt=en-IN&adlt=moderate" class="rounded-circle">
						<div class="text-center mt-2"><?php echo $genre["genre"]; ?></div>
					</div>
					<?php } ?>
				</div>
			</section>
			<section class="mt-4">
				<h2 class="section-title">Your Favorite Artists</h2>
				<div class="main-carousel" data-flickity='{ "cellAlign": "left", "contain": true }'>
				<!-- <div class="row"> -->
					<?php $a = DB::query("SELECT DISTINCT artist FROM likes WHERE who_likes=%s", $_GET["id"]);
						foreach ($a as $artist) { ?>
					<div class="carousel-cell">
						<img alt="" src="https://tse2.mm.bing.net/th?q=<?php echo $artist["artist"]; ?>&w=70&h=70&c=7&rs=1&p=0&dpr=3&pid=1.7&mkt=en-IN&adlt=moderate" class="rounded-circle">
						<div class="text-center mt-2"><?php echo $artist["artist"]; ?></div>
					</div>
					<?php } ?>
				</div>
			</section>
		</main>

		<footer id="colophon">
			<div class="container-fluid">
				<div class="row">
					<a href="./?id=<?php echo $_GET["id"]; ?>" class="col">
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
					<a href="./settings.php?id=<?php echo $_GET["id"]; ?>" class="col active">
						<i class="ion ion-ios-settings"></i>
						<div class="label">Settings</div>
					</a>
				</div>
			</div>
			</footer>

<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-dark">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel3"><i class="ion ion-md-alert mr-2"></i>QR Code</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center p-5">
				<img alt="" src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={%22name%22:%22Mike+Smith%22,%22bloodgroup%22:%22B+%22,%22diseases%22:%22none%22,%22ice%22:%22+919555297989%22,%22allergies%22:%22none%22}">
				<p class="mt-4">
					<strong>Name</strong>: Mike Smith<br>
					<strong>Blood Group</strong>: B+<br>
					<strong>Diseases</strong>: None<br>
					<strong>Allergies</strong>: None<br>
					<strong>Emergency No.</strong>: +31655297989<br>
				</p>
			</div>
		</div>
	</div>
</div>
			
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" hidden>
			Launch demo modal
		</button>

		

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