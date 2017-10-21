<?php
	session_start();
	include "db.php";
	$me = $_GET["id"];
	$genre = $_GET["genre"];
	$artist = $_GET["artist"];
	$action = $_GET["action"];
	DB::insert("likes", [
		"who_likes" => $me,
		"artist" => $artist,
		"genre" => $genre,
		"like_or_dislike" => $action
	]);
	header("Location: taste.php?id=" . $me);
?>