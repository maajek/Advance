<?php

	session_start();

	$adminName = $_SESSION['name'];

	echo "Welcome $adminName";

?>