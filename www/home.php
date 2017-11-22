<?php

	session_start();

	$admin_id = $_SESSION['admin_id'];


	$page_title = "Home";
	include('include/header.php');

	include('include/db.php');

	include('include/function.php');

?>


<div class="wrapper">
	<h2 align="center">Welcome to Home page</h2>




</div>

<?php
	
	include('include/footer.php');

?>