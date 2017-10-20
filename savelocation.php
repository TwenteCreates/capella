<?php
	include_once "db.php";
	DB::update("users", [
		"location" => $_POST["cords"]
	], "id=%s", $_POST["id"]);
	echo DB::queryFirstRow("SELECT isSomeoneLookingForMe as a from users WHERE id=%s", $_POST["id"])["a"];
?>