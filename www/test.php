<?php
  define('MAX_FILE_SIZE','2097152');
  $ext = ['image/jpg','image/jpeg','image/png'];
  
      if(array_key_exists('save',$_POST)) {
	  // print_r($_FILES);
	      $errors = [];
	  
	  if(empty($_FILES['pics'])) {
		  $errors[]="Please select a file" ;
		}
	  if($_FILES['pics']['size'] > MAX_FILE_SIZE) {
		  $errors[]="File too large. Maximum: ".MAX_FILE_SIZE;   
		}
	  if(!in_array($_FILES['pics']['type'],$ext)){
		  $errors[]="File format not supported" ;
		}
		
		  $rnd =rand(0000000000,9999999999);
		  $strip_name=str_replace('','_',$_FILES['pics']['name']);
		  $filename = $rnd.$strip_name;
		  $destination= './uploads/'.$filename;
		
	  if(!move_uploaded_file($_FILES['pics']['tmp_name'],$destination)) {
		  $errors[]= "File not uploaded";
		}
	  if(empty($errors)){
		   echo "File upload succesfull";
	    }else{
		   foreach($errors as $err) {
			 echo $err. '</br>';
			   
			   }
		}
   }
?> 





<form id="register" method="POST" enctype="multipart/form-data">
    <p>Please upload a picture</p>
    <input type="file" name="pics" />
    
    <input type="submit" name="save" />


</form>