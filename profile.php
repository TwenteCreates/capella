<?php
	include "db.php";
	session_start();
	$friends = DB::query("SELECT * FROM friends WHERE friend1=%s OR friend2=%s", $_GET["id"]);
	$me = $_GET["id"];
	if (!$me) {
		header("Location: ?id=1");
	}
	$user = DB::queryFirstRow("SELECT * FROM users WHERE id=%s", $_GET["user"]);
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
			<?php if (DB::queryFirstRow("SELECT * FROM friends WHERE friend1=%s AND friend2=%s OR friend1=%s AND friend2=%s", $_GET["id"], $_GET["user"], $_GET["user"], $_GET["id"])) { ?><section>
				<div class="card text-white bg-dark friend-card mb-4">
					<div class="card-header"><i class="ion ion-ios-pin mr-2"></i><?php echo $user["name"]; ?>'s Live Location</div>
					<div class="card-body">
						<div class="text-center">
							<span class="arrow-span" style="display: none; font-size:48px"><i class="ion ion-md-arrow-back"></i></span>
						</div>
						<p id="ajdfds">Calculating...</p>
						<img class="mb-3" alt="" src="https://maps.googleapis.com/maps/api/staticmap?zoom=18&size=400x250&maptype=roadmap&markers=<?php echo json_decode($user["location"])[0] . ",+" . json_decode($user["location"])[1]; ?>&key=AIzaSyCuiZevIb1G87KAoLRSECEdWNBQ06JCMjU">
						<button class="btn btn-primary mr-1" onclick="pingUser('<?php echo $user["id"]; ?>', null)"><i class="ion ion-ios-notifications mr-2"></i><span id="pingText">Ping</span></button>
						<a href="tel:+31644691056" class="btn btn-secondary mr-1"><i class="ion ion-ios-call mr-2"></i>Call</a>
						<button class="btn btn-secondary"><i class="ion ion-md-volume-up mr-2"></i>Ring</button>
						<p class="text-muted small mt-3 mb-0">By pinging <?php echo $user["name"]; ?>, you'll vibrate her phone and share your location with her.</p>
					</div>
				</div>
				<div class="main-carousel" data-flickity='{ "cellAlign": "left", "contain": true }'>
					<?php foreach ($friends as $friend1) {
						$m1 = "friend1";
						if ($friend1["friend1"] == $me) { $m1 = "friend2"; }
						$friend = DB::queryFirstRow("SELECT * FROM users WHERE id=%s", $friend1[$m1]); ?>
					<div class="carousel-cell">
						<a href="profile.php?id=<?php echo $me; ?>&user=<?php echo $friend["id"]; ?>" class="<?php if ($_GET["user"] == $friend["id"]) { echo "currentprofile"; } ?>">
							<img onclick="getUserLocation('<?php echo $friend["id"]; ?>');" alt="" src="<?php echo $friend["avatar"]; ?>" class="rounded-circle">
						</a>
					<?php if ($_GET["user"] == $friend["id"]) { ?>
						<button onclick="removeFriend();" class="btn btn-secondary mt-3 btn-sm">Unfriend</button>
					<?php } ?>
					</div>
					<?php } ?>
				</div>
			</section>
			<?php } else { ?>
				<section>
					<div class="row p-3">
						<div class="col-4">
							<img alt="" src="<?php echo $user["avatar"]; ?>" class="rounded-circle">
						</div>
						<div class="col">
							<div><strong><?php echo $user["name"]; ?></strong></div>
							<div><span><?php echo $user["tel"]; ?></span></div>
						</div>
					</div>
				</section>
				<section>
					<h2 class="section-title">Friends</h2>
					<div class="main-carousel" data-flickity='{ "cellAlign": "left", "contain": true }'>
					<!-- <div class="row"> -->
						<?php $friends = DB::query("SELECT * FROM friends WHERE friend1=%s OR friend2=%s", $_GET["user"]); foreach ($friends as $friend1) {
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
					<button class="btn btn-primary mt-3 btn-block" onclick="addFriend()";>Add Friend</button>
				</section>
			<?php } ?>
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
				navigator.geolocation.getCurrentPosition(function(position) {
					var p1 = {
						x: <?php echo json_decode($user["location"])[0]; ?>,
						y: <?php echo json_decode($user["location"])[1]; ?>
					};
					var p2 = {
						x: position.coords.latitude,
						y: position.coords.longitude
					};
					var angleDeg = Math.atan2(p2.y - p1.y, p2.x - p1.x) * 180 / Math.PI;
					var a = <?php echo json_decode($user["location"])[0]; ?> - position.coords.latitude;
					var b = <?php echo json_decode($user["location"])[1]; ?> - position.coords.longitude;
					var c = Math.sqrt(a*a + b*b);
					$("#ajdfds").html("Move in this direction for " + parseInt(c*69.172*1.60934*1000) + " meters");
					var prevalpha = 0; var x = 0;
					window.addEventListener("deviceorientation", function(event) {
						var alpha = event.alpha;
						if (x == 0) {
							prevalpha = alpha;
							x = 1;
						} else {
							alpha -= prevalpha;
						}
						$(".arrow-span").css("transform", "rotate(" + parseInt(angleDeg + alpha) + "deg)");
					}, true);
					$(".arrow-span").css("display", "inline-block");
				});
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
			console.log(type);
			$("#pingText").text("Pinging...");
			$("#pingText").css("opacity", 0.5);
			console.log("pingme.php?id=<?php echo $_GET["id"]; ?>&user=" + user + "&type=" + type);
			$.get("pingme.php?id=<?php echo $_GET["id"]; ?>&user=" + user + "&type=" + type, function() {
				$("#pingText").text("Ping");
				$("#pingText").css("opacity", 1);
			});
		}
		function emergency() {
			$('[data-target="#exampleModal2"]').click();
		}
		function addFriend() {
			$.get("addfriend.php?me=<?php echo $_GET["id"]; ?>&you=<?php echo $_GET["user"]; ?>", function() {
				window.location.reload(1);
			});
		}
		function removeFriend() {
			$.get("removefriend.php?me=<?php echo $_GET["id"]; ?>&you=<?php echo $_GET["user"]; ?>", function() {
				window.location.reload(1);
			});
		}
	</script>

</body>

</html>