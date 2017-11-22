	<?php

		session_start();

		$page_title="Admin Dashboard";

		include 'include/functions.php';
		include 'include/dashboard-header.php';
		include 'include/db.php';

		checkLogin();

		$errors = [];

		if (array_key_exists('add', $_POST)) {
			if (empty($_POST['cat_name'])) {
				$errors['cat_name'] = "Please enter a category name";
			}

			if (empty($errors)) {
				$clean = array_map('trim', $_POST);

				addCategory($conn, $clean);`
				header("location: view-category.php");
			}
		}

	?>



	<div class="wrapper">
		<div id="stream">
			<form id="register"  action ="" method ="POST">
				<div>
					<?php 
						$info = displayErrors($errors, 'cat_name');
						echo $info;
					 ?>
					<label>Add Category:</label>
					<input type="text" name="cat_name" placeholder="Enter Category Name">
				</div>
					<input type="submit" name="add" value="Add"> 
			</form>
		</div>
	</div>