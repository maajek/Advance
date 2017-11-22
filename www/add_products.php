<?php
	
	$page_title = "Add Products";

	include('include/functions.php');

	include('include/dashboard_header.php');

	include('include/db.php');
	
	/*checkLogin();*/

	
	$error = [];

	$flag = ['Top-Selling', 'Trending', 'Recently-Viewd'];

	$stmt = $conn->prepare("SELECT * FROM category");
	$stmt -> execute();

	define('MAX_FILE_SIZE', 2097152);

	$ext = ['image/jpeg', 'image/jpg', 'image/png'];

	if(array_key_exists('add', $_POST)){
	
		if(empty($_POST['title'])){
			$error['title']= "Please enter Book title";
		}
		if(empty($_POST['author'])){
			$error['author']= "Please enter book author";
		}

		$clean = array_map('trim', $_POST);

		if(empty($_POST['price'])){
			$error['price']= "Please enter book price";
		} else{
			$price = numeric($clean['price']);

			if($price){
				echo "Enter price in digits";
			}
		}
		if(empty($_POST['pub_date'])){
			$error['pub_date'] = "Select the date of publication";
		}
		
		if(empty($_POST['cat'])){
			$error['cat']= "Select a category";
		}

		if(empty($_POST['flag'])){
			$error['flag']= "Select a flag";
		}

		if(empty($_FILES['image']['name'])){
			$error['image']= "Select an image";
		}

		if($_FILES['image']['size'] > MAX_FILE_SIZE){
			$error['image'] = "Image size too large";
		}

		if(!in_array($_FILES['image']['type'], $ext)){
			$error['image'] = "Image type not supported";
		}


		if(empty($error)){

			$img = uploadFile($_FILES, 'image', 'uploads/');

			if($img[0]){

				$location = $img[1];
			}

			$clean = array_map('trim', $_POST);
			$clean['dest'] = $location;

			addProduct($conn, $clean);
			redirect("view_products.php");



			/*$row = $stmt->fetch(PDO::FETCH_BOTH);

			$cat_id = $row[0];

			addProduct($conn, $_POST, $cat_id);
			redirect("add_products.php");*/
		}

	}
?>

<div class="wrapper">
		<h1 id="register-label">Add products</h1>
		<hr>
		<form id="register"  action ="" method ="POST" enctype="multipart/form-data">
			<div>
				<?php 
				$info = displayErrors($error, 'title');
				echo $info;
				?>
				<label>Title:</label>
				<input type="text" name="title" placeholder="Title">
			</div>
			<div>
				<?php 
				$info = displayErrors($error, 'author');
				echo $info;
				?>
				<label>Author:</label>	
				<input type="text" name="author" placeholder="Author">
			</div>

			<div>
				<?php 
				$info = displayErrors($error, 'price');
				echo $info;
				?>
				<label>Price:</label>
				<input type="text" name="price" placeholder="Price">
			</div>
			<div>
				<?php 
				$info = displayErrors($error, 'pub_date');
				echo $info;
				?>
				<label>publication date:</label>
				<input type="text" name="pub_date" placeholder="Publication date">
			</div>
 

			<div>
				<?php 
				$info = displayErrors($error,'cat');
				echo $info;
				?>
				<label>Category:</label> 
				<select name="cat">
					<option>Select Category</option>
					<?php
						$data = fetchCategory($conn);
						echo $data;
					?>
				</select>

			</div>
			<div>
				<?php 
					$info = displayErrors($error,'flag');
					echo $info;
				?>
				<label>Flag:</label>
				<select name="flag">
					<option>Select Flag</option>
					<?php foreach ($flag as $fl) {?>
					<option value="<?php echo $fl ?>">
						<?php echo $fl ?>
					</option>
					<?php } ?>

				</select>
			</div>

			<div>
				<?php
					$info = displayErrors($error, 'image');
					echo $info;
				?>
				<label>Image:</label>
				<input type="file" name="image">
			</div>	

			<p><input type="submit" name="add" value="Add"></p>
		</form>
	</div>

	<?php
		include('include/footer.php');
	?>
