<?php
	session_start();

	$page_title = "Add Category";
	
	include('include/functions.php');
	
	include('include/dashboard_header.php');

	include('include/db.php');



	checkLogin();

	$error = [];

	if(array_key_exists('add', $_POST)){
		if(empty($_POST['cat_name'])){
			$error['cat_name'] = "Please enter category name";
		}

		if(empty($error)){

			$clean = array_map('trim', $_POST);

			addCategory($conn, $clean);

			redirect("view_category.php?msg= ", "");

		}

	}


?>

<div class="wrapper">
	<div id="stream">
		<form id="register"  action ="add_category.php" method ="POST">
			<div>
				<?php
					$info = displayErrors($error, 'cat_name');
					echo $info;

				?>
				<label>Add Category:</label>
				<input type="text" name="cat_name" placeholder="Category name">
			</div>
				<input type="submit" name="add" value="Add">
		</form>
	</div>
</div>

<?php

	include('include/footer.php');

?>