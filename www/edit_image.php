<?php

session_start();
$page_title ="Edit image";

    include('include/db.php');
    include('include/functions.php');
    include('include/dashboard_header.php');

  checkLogin();

  if($_GET['img']){

 	$book_id = $_GET['img'];
 }

     $error =[];

	define('MAX_FILE_SIZE', 2097152);

   $ext = ['image/jpeg', 'image/jpg', 'image/png'];

  if(array_key_exists('pic',$_POST)){

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

          $img = uploadFile($_FILES,'image','uploads/');
          
          if($img[0]){
             $dest = $img[1];

          }

          updateimage($conn, $book_id, $dest);

		  redirect("view_products.php");

      }

  }
?>            

<div class="wrapper">
<form id="register" action="" method="POST" enctype="multipart/form-data">
            <div>
				<?php
					$info = displayErrors($error, 'image');
					echo $info;
				?>
				<label>Image:</label>
				<input type="file" name="image">
			</div>	

			<input type="submit" name="pic">
</form>
</div>