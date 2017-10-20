<?php
	include "db.php";
	$start_time = time();
	$a = 0;
	a: if (intval(DB::queryFirstRow("SELECT isSomeoneLookingForMe as a FROM users WHERE id=%s", $_GET["id"])["a"]) === 0) {
		$a++;
		usleep(3000000);
		goto a;
	} else {
		DB::update("users", [
			"isSomeoneLookingForMe" => 0
		], "id=%s", $_GET["id"]);
		echo $_GET["id"];
	}
?>