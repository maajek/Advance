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

    $item = getProductbyId($conn, $book_id);



  	$error = [];

	$flag = ['Top-Selling', 'Trending', 'Recently-Viewd'];

	$stmt = $conn->prepare("SELECT * FROM category");
	$stmt -> execute();

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

		if(empty($error)){

			$clean = array_map('trim', $_POST);
		  
		  $clean['id'] = $book_id;

          updateProductbyId($conn, $clean);

			redirect("view_products.php");

		}

	}
?>

<div class="wrapper">
		<h1 id="register-label">Edit products</h1>
		<hr>
		<form id="register"  action ="" method ="POST" enctype="multipart/form-data">
			<div>
				<?php 
				$info = displayErrors($error, 'title');
				echo $info;
				?>
				<label>Title:</label>
				<input type="text" name="title" placeholder="Title" value="<?php echo $item[1]?>">
			</div>
			<div>
				<?php 
				$info = displayErrors($error, 'author');
				echo $info;
				?>
				<label>Author:</label>	
				<input type="text" name="author" placeholder="Author" value="<?php echo $item[2]?>">
			</div>

			<div>
				<?php 
				$info = displayErrors($error, 'price');
				echo $info;
				?>
				<label>Price:</label>
				<input type="text" name="price" placeholder="Price" value="<?php echo $item[3]?>">
			</div>
			<div>
				<?php 
				$info = displayErrors($error, 'pub_date');
				echo $info;
				?>
				<label>publication date:</label>
				<input type="text" name="pub_date" placeholder="Publication date" value="<?php echo $item[4]?>">
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

			<p><input type="submit" name="add" value="Edit"></p>
		</form>
	</div>