<?php

	function adminRegister($dbconn, $input){

		$hash = password_hash($input['password'], PASSWORD_BCRYPT);

			$statement = $dbconn->prepare("INSERT INTO admin(firstname, lastname, email, hash) VALUES(:f, :l, :e, :h)");

			$data = [":f" => $input['fname'],
					":l" => $input['lname'],
					":e" => $input['email'],
					":h" => $hash
			];

			$statement->execute($data);
	}

	function doesEmailExist($dbconn, $email) {
		$result = false;

		$statement = $dbconn->prepare("SELECT email FROM admin WHERE :e=email");

		$statement->bindParam(":e", $email);
		$statement->execute();

		$count = $statement->rowCount();

		if($count > 0) {
			$result = true;
		}

		return $result;
	}

	function displayErrors($errors, $name) {

		$result = "";

		if (isset($errors[$name])) {
			'<span class="err">' .$errors[$name]. '</span>';
		}

		return $result;
	}


	function adminLogin($dbconn, $input){
		$result = [];

		$statement = $dbconn->prepare("SELECT * FROM admin WHERE email=:e");

		$statement->bindParam(':e', $input['email']);
		$statement->execute();

		$count = $statement->rowCount();
		$row = $statement->fetch(PDO::FETCH_ASSOC);

		if ($count != 1 || !password_verify($input['password'], $row['hash'])) {
			$result[] = false;
		}else {
			$result[] = true;
			$result[] = $row;
		}

		return $result;
	}


	function addCategory($dbconn, $input){
		$statement = $dbconn->prepare("INSERT INTO category(category_name) VALUES(:catName)");

		$statement->bindParam(':catName', $input['cat_name']);

		$statement->execute();
	}

	function checkLogin(){
		if (!isset($_SESSION['admin_id'])) {
			header("location: login.php");
		}
	}


	function redirect($location, $msg){

		header("location: ".$location.$msg);

	}



	function viewCategory($dbconn){

		$result = "";

		$statement = $dbconn->prepare("SELECT * FROM category");

		$statement->execute();

		while ($row = $statement->fetch(PDO::FETCH_BOTH)) {
			
			$result .= '<tr><td>' .$row[0]. '</td>';
			$result .= '<td>' .$row[1]. '</td>';
			$result .= '<td><a href="edit-category.php?cat_id='.$row[0].'">edit</a></td>';
			$result .= '<td><a href="edit-category.php?cat_id='.$row[0].'">delete</a></td></tr>';


		}

		return $result;

	}


	function getCategoryById($dbconn, $id){

		$statement = $dbconn->prepare("SELECT * FROM category WHERE category_id=:catId");

		$statement->bindParam(':catId', $id);
		$statement->execute();

		$row = $statement->fetch(PDO::FETCH_BOTH);

		return $row;
	}


	function updateCategory($dbconn, $input){

		$statement = $dbconn->prepare("UPDATE category SET category_name=:catName WHERE category_id=:catId");

		$data = [
			":catName" => $input['edit_category'],
			":catId" => $input['id']
		];

		$statement->execute($data);

	}

	function curNav($page){

		$curPage = basename($_SERVER['SCRIPT_FILENAME']);

		if ($curPage == $page) {
			echo "class='selected'";

		}

	}


?>