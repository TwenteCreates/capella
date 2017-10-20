<?php
	$start_time = time();
	$a = 0;
	a: if ($a < 5) {
		$a++;
		usleep(1000000);
		goto a;
	} else {
		echo "five seconds";
		echo $_GET["id"];
	}
?>