	
	<?php

		session_start();

		$page_title = "Login";
		include 'include/header.php';
		include 'include/db.php';
		include 'include/functions.php';

		$errors = [];

		if (array_key_exists('login', $_POST)) {
			if (empty($_POST['email'])) {
				$errors['email'] = "Enter your email";
			}

			if (empty($_POST['password'])) {
				$errors['password'] = "Enter your password";
			}

			if (empty($errors)) {
				$clean = array_map('trim', $_POST);

				$data = adminLogin($conn, $clean);

				if ($data[0]) {

					$details = $data[1];

					$_SESSION['admin_id'] = $details['admin_id'];
					$_SESSION['name'] = $details['firstname'] .' '. $details['lastname'];

					redirect("add-category.php?msg=", "admin successfully logged in");
				} else {
					header("location:login.php?msg='Invalid email or password'");
				}

			}
		}
	?>
	
	<div class="wrapper">
		<h1 id="register-label">Admin Login</h1>
		<hr>
		<form id="register"  action ="login.php" method ="POST">
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

			<input type="submit" name="login" value="login">
		</form>

		<h4 class="jumpto">Don't have an account? <a href="register.php">register</a></h4>
	</div>

	<?php
		include 'include/footer.php';
	?>

	