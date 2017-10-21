<?php
	include "db.php";
	session_start();
	$genres = ["Jazz", "Folk", "Blues", "Rock", "Hip hop", "Pop", "Reggae", "Country", "Classical period", "Punk rock", "Rhythm and blues", "Singing", "Popular", "Rapping", "Alternative rock", "Classical", "Electronic dance", "Opera", "Techno", "Soul", "Funk", "House", "Instrumental", "Disco", "Art", "Trance", "Independent", "Heavy metal", "Gospel", "Breakbeat", "Electro", "Jazz fusion", "Dubstep", "Acoustic", "Ambient", "Orchestra", "Drum and bass", "Grunge", "Soundtrack", "Chant", "Ska", "Dance", "Dub", "Psychedelic", "Hardstyle", "Dancehall", "World", "EDM", "Bluegrass", "Downtempo"];
	$randMe = $genres[array_rand($genres, 1)];
	$a = json_decode(file_get_contents("https://itunes.apple.com/search?term=" . $randMe . "&limit=20&media=music"));
	$song = $a->results[array_rand($a->results, 1)];
	if (!$song) {
		header("Refresh: 0");
	}
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

		<link rel="stylesheet" href="https://unpkg.com/flickity@2.0.10/dist/flickity.css">
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
			<div class="title">Taste</div>
			<button class="btn btn-outline-danger top-right-button"><i class="ion ion-ios-alert"></i></button>
		</header>

		<main id="content">
			<section>
				<div class="card text-white bg-dark">
					<div class="card-header"><i class="ion ion-ios-musical-note mr-2"></i><?php echo $song->trackName; ?></div>
					<div class="card-body">
						<audio class="mb-3" src="<?php echo $song->previewUrl; ?>" controls></audio>
						<div class="row text-center like-unlike">
							<a href="savetaste.php?id=<?php echo $me; ?>&genre=<?php echo urlencode($song->primaryGenreName); ?>&artist=<?php echo urlencode($song->artistName); ?>&action=dislike" class="col">
								<i class="ion ion-ios-thumbs-down"></i>
								<div>Dislike</div>
							</a>
							<a href="savetaste.php?id=<?php echo $me; ?>&genre=<?php echo urlencode($song->primaryGenreName); ?>&artist=<?php echo urlencode($song->artistName); ?>&action=like" class="col">
								<i class="ion ion-ios-thumbs-up"></i>
								<div>Like</div>
							</a>
						</div>
					</div>
				</div>
				<div class="card text-white bg-dark mt-3">
					<div class="card-header"><i class="ion ion-ios-information-circle mr-2"></i>Details</div>
					<div class="card-body">
						<div class="row song-info">
							<div class="col-4 pr-0">
								<img alt="" src="<?php echo $song->artworkUrl100; ?>">
							</div>
							<div class="col">
								<div><strong><?php echo $song->trackName; ?></strong></div>
								<div><?php echo $song->artistName; ?></div>
								<div class="text-muted"><?php echo $song->primaryGenreName; ?></div>
							</div>
						</div>
						<div class="row mt-3">
							<div class="col">
								<a href="https://duckduckgo.com/?q=!ducky+<?php echo urlencode($song->trackName . " " . $song->artistName); ?>+site%3Aitunes.apple.com" target="_blank">
									<img alt="" src="https://tse2.mm.bing.net/th?q=Apple+music+app+icon&w=70&h=70&c=7&rs=1&p=0&dpr=3&pid=1.7&mkt=en-IN&adlt=moderate" class="rounded-circle">
								</a>
							</div>
							<div class="col">
								<a href="https://duckduckgo.com/?q=!ducky+<?php echo urlencode($song->trackName . " " . $song->artistName); ?>+site%3Ayoutube.com" target="_blank">
									<img alt="" src="https://tse2.mm.bing.net/th?q=YouTube+app+icon&w=70&h=70&c=7&rs=1&p=0&dpr=3&pid=1.7&mkt=en-IN&adlt=moderate" class="rounded-circle">
								</a>
							</div>
							<div class="col">
								<a href="https://duckduckgo.com/?q=!ducky+<?php echo urlencode($song->trackName . " " . $song->artistName); ?>+site%3Asoundcloud.com" target="_blank">
									<img alt="" src="https://tse2.mm.bing.net/th?q=Soundcloud+app+icon&w=70&h=70&c=7&rs=1&p=0&dpr=3&pid=1.7&mkt=en-IN&adlt=moderate" class="rounded-circle">
								</a>
							</div>
							<div class="col">
								<a href="https://duckduckgo.com/?q=!ducky+<?php echo urlencode($song->trackName . " " . $song->artistName); ?>+site%3Aplay.google.com" target="_blank">
									<img alt="" src="https://tse2.mm.bing.net/th?q=Google+Play+Music+app+icon&w=70&h=70&c=7&rs=1&p=0&dpr=3&pid=1.7&mkt=en-IN&adlt=moderate" class="rounded-circle">
								</a>
							</div>
							<div class="col">
								<a href="https://duckduckgo.com/?q=!ducky+<?php echo urlencode($song->trackName . " " . $song->artistName); ?>+site%3Aopen.spotify.com" target="_blank">
									<img alt="" src="https://tse2.mm.bing.net/th?q=Spotify+new+icon&w=70&h=70&c=7&rs=1&p=0&dpr=3&pid=1.7&mkt=en-IN&adlt=moderate" class="rounded-circle">
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="card text-white bg-dark mt-3">
					<div class="card-header"><i class="ion ion-ios-list mr-2"></i>Lyrics</div>
					<div class="card-body">
						<a href="https://duckduckgo.com/?q=!ducky+<?php echo urlencode($song->trackName . " " . $song->artistName); ?>+lyrics" target="_blank" class="btn btn-secondary btn-block">Open Song Lyrics</a>
					</div>
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
					<a href="./taste.php?id=<?php echo $_GET["id"]; ?>" class="col active">
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
					}, 15000);
				}
			});
		</script>

	</body>

</html>