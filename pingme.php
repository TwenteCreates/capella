<?php
	session_start();
	include_once "db.php";
	$me = $_GET["id"];
	$user = $_GET["user"];
	if ($_GET["type"] == "emergency") {
		$type = 1;
	}
	DB::update("users", [
		"isSomeoneLookingForMe" => 1,
		"need_help" => $type,
		"who_is_looking" => $_GET["id"],
		"who_is_looking_name" => DB::queryFirstRow("SELECT name FROM users WHERE id=%s", $_GET["id"])["name"]
	], "id=%s", $_GET["user"]);
	echo $_GET["type"];
?>