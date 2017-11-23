<?php
	
	$page_title = "Add Products";

	include('include/functions.php');

	include('include/dashboard_header.php');

	include('include/db.php');
	
	//checkLogin();

if($_GET['book_id']){

 	$book_id = $_GET['book_id'];
 }

    $item = getProductbyId($conn, $book_id);
           
	$category = getCategoryById($conn, $item[5]);

	$error = [];


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


		if(empty($error)){
           $clean =array_map('trim', $_POST);
           $clean['id'] = $book_id;

			updateProductbyid($conn, $clean);
			redirect("view_products.php");



			/*$row = $stmt->fetch(PDO::FETCH_BOTH);

			$cat_id = $row[0];

			addProduct($conn, $_POST, $cat_id);
			redirect("add_products.php");*/
		}

	}
?>

<div class="wrapper">
		<h1 id="register-label">Edit products</h1>
		<hr>
		<form id="register"  action ="" method ="POST">
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
					<option value="<?php echo $category[1]; ?>"><?php echo $category[1]; ?></option>
					<?php
						$data = fetchCategory($conn, $category[1]);
						echo $data;
					?>
				</select>

			</div>


			<p><input type="submit" name="add" value="Edit Product"></p>
		</form>
		<h4 class="jumpto">To edit product image? <a href='edit_image.php?img=<?php echo $book_id; ?>'>Click here</a></h4>
	</div>


	<?php
		include('include/footer.php');
	?>
