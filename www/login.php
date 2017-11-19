	<?php

	 $page_title = "Login";
  include 'include/header.php';
  include 'include/db.php';

  include 'include/functions.php';
      $error = [];
      
      if(array_key_exists('register', $_POST)) {
        
      
      if(empty($_POST['email'])){
         $error['email'] = "Please enter you email" ;
      }

      if(empty($_POST['password'])) {
      	 $error['password']= "Please enter your password";
      }

      if(empty($error)) {
        //do data base stuff

       /* $stmt = $conn->prepare("SELECT FROM admin(email,hash)VALUES(:e,:h)");
         
        $data =[ 
            ":e"=> $email,
            ":h"=> $hash
        ];
           
        $stmt -> execute($data);*/
       $stmt = $conn->prepare("SELECT email FROM admin WHERE :e=email");
       $stmt -> bindParam(":e" , $email);
       $stmt->execute();
      
       $stmt = $conn->prepare("SELECT password FROM admin WHERE :h=hash");
       $stmt -> bindParam(":h" , $hash);
       $stmt->execute();

      header ("location:testing.php");


       }

     }

	?>



	<div class="wrapper">
		<h1 id="register-label">Admin Login</h1>
		<hr>
		<form id="register"  action ="login.php" method ="POST">
			<div>
				 <?php 
                 $data = displayErrors($error,'email');
                 echo $data;

			    ?>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
				 <?php 
                 $data = displayErrors($error,'password');
                 echo $data;

			     ?>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>

			<input type="submit" name="register" value="login">
		</form>

		<h4 class="jumpto">Don't have an account? <a href="register.php">register</a></h4>
	</div>

	<?php
  include 'include/footer.php';


	?>