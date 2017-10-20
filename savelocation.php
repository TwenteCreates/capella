<?php
	include_once "db.php";
	DB::update("users", [
		"location" => $_POST["cords"]
	], "id=%s", $_POST["id"]);
	$a = DB::queryFirstRow("SELECT isSomeoneLookingForMe as a from users WHERE id=%s", $_POST["id"])["a"];
	echo $a;
	if ($a == 1) {
		DB::update("users", [
			"isSomeoneLookingForMe" => 0
		], "id=%s", $_POST["id"]);
	}
?>