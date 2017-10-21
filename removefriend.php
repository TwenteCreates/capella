<?php
	include_once "db.php";
	session_start();
	DB::delete("friends", "friend1=%s AND friend2=%s", $_GET["me"], $_GET["you"]);
?>