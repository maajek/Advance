<?php
	session_start();
	$page_title = "Admin Dashboard";
	
	include('include/functions.php');
	include('include/dashboard_header.php');

	include('include/db.php');


	checkLogin();

 if($_GET['book_id']){

 	$book_id = $_GET['book_id'];
 }
		
		  
		  $clean['id'] = $book_id;

          deleteProduct($conn, $clean);

			redirect("view_products.php");

		

	
?>

