<?php
	include_once "db.php";
	session_start();
	DB::insert("friends", [
		"friend1" => $_GET["me"],
		"friend2" => $_GET["you"]
	]);
?>