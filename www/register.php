  <?php
   
   $page_title ="Register";
    include 'include/header.php';

    include 'include/db.php';

    include 'include/functions.php';
    $errors = [];
   
    if(array_key_exists('register', $_POST)) {
     
    if(empty($_POST['fname'])) {
       $errors['fname']="Please enter your firstname";
   }
        
    if(empty($_POST['lname'])) {
       $errors['lname']="Please enter your lastname";
   }
    
           
    if(empty($_POST['email'])) {
       $errors['email']="Please enter your email";
   }
     
     if(doesEmailExist($conn,$_POST['email'])) {
       $errors['email'] = "Email already exist";


     }       
    if(empty($_POST['password'])) {
       $errors['password']="Please enter your password";
   }
           
    if(empty($_POST['pword'])) {
       $errors['pword']="Please confirm your password";
   }
            
    if(empty($errors)) {
      #do database stuff
     $clean = array_map('trim',$_POST);
     /*$hash = password_hash($clean['password'],PASSWORD_BCRYPT);
     $stmt = $conn->prepare("INSERT INTO admin(firstname,lastname,email,hash)VALUES(:f,:l,:e,:h)");

     $data = [
          ":f" => $clean['fname'],
          ":l" => $clean['lname'],
          ":e" => $clean['email'],
          ":h" => $hash
        ];

        $stmt ->execute($data);*/
        doadminRegister($conn,$clean);
      }

    }

   
 ?>


<div class="wrapper">
		<h1 id="register-label">Register</h1>
		<hr>
		<form id="register"  action ="register.php" method ="POST">
			<div>
			 <?php 
               $data = displayErrors($errors,'fname');
                 echo $data;

			  ?>
				<label>first name:</label>
				<input type="text" name="fname" placeholder="first name">
			</div>
			<div>
			<?php  
			$data = displayErrors($errors,'lname');
                 echo $data; 
              ?>
				<label>last name:</label>	
				<input type="text" name="lname" placeholder="last name">
			</div>

			<div>
			<?php 
                $data = displayErrors($errors,'email');
                 echo $data;
			 ?>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
			<?php 
                 $data = displayErrors($errors,'password');
                 echo $data;

			  ?>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>
 
			<div>
			<?php if(isset($errors['pword'])){echo '<span class=err>'.$errors['pword'].'</span>';}  ?>
				<label>confirm password:</label>	
				<input type="password" name="pword" placeholder="password">
			</div>

			<input type="submit" name="register" value="register">
		</form>

		<h4 class="jumpto">Have an account? <a href="login.php">login</a></h4>
	</div>

	<?php 
       include 'include/footer.php';

	?>