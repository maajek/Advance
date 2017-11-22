<?php
	session_start();

	$page_title = "Edit Category";

	include('include/functions.php');
	
	include('include/dashboard_header.php');

	include('include/db.php');

	


	checkLogin();

	if($_GET['cat_id']){
		$cat_id = $_GET['cat_id'];
	}

	$item = getCategoryById($conn, $cat_id);

	$error = [];

	if(array_key_exists('delete', $_POST)){

		if(empty($_POST['cat_name'])){
			$error['cat_name'] = "Please enter category name";
		}

		if(empty($error)){
			$clean = array_map('trim', $_POST);

			$clean['id'] = $cat_id;

			deleteCategory($conn, $clean);

			redirect("view_category.php");

		}

	}


?>

<div class="wrapper">
	<div id="stream">
		<form id="register"  action ="" method ="POST">
			<div>
				<?php
					$info = displayErrors($error, 'cat_name');
					echo $info;

				?>
				<label>Delete Category:</label>
				<input type="text" name="cat_name" placeholder="Category name" value="<?php echo $item[1]; ?>">
			</div>
				<input type="submit" name="delete" value="Delete">
		</form>
	</div>
</div>

<?php

	include('include/footer.php');

?>