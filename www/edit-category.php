	<?php

		session_start();

		$pagetitle = "Admin Dashboard";

		include 'include/functions.php';
		include 'include/dashboard-header.php';
		include 'include/db.php';

		checkLogin();

		if ($_GET['cat_id']) {
			$cat_id = $_GET['cat_id'];
		}

		$item = getCategoryById($conn, $cat_id);

		$errors = [];

		if (array_key_exists('edit', $_POST)) {
			if (empty($_POST['edit_category'])) {
				$errors['edit_category'] = "Please enter a category name";
			}

			if (empty($errors)) {
				
				$clean = array_map('trim', $_POST);
				$clean['id'] = $cat_id;

				updateCategory($conn, $clean);

				redirect("view-category.php");

			}
		}

	?>



	<div class="wrapper">
		<div id="stream">
			<form id="register"  action ="" method ="POST">
				<div>
					<?php 
						//$info = displayErrors($errors, 'edit_category');
						//echo $info;
					 ?>
					<label>Edit Category:</label>
					<input type="text" name="edit_category" placeholder="Edit Category Name" value="<?php echo $item[1]; ?>">
				</div>
					<input type="submit" name="edit" value="Edit"> 
			</form>
		</div>
	</div>