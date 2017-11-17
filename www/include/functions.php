<?php
  function uploadFile($files,$name,$loc) {
     $result =[];

     $rnd = rand(0000000000,9999999999);
     $strip_name = str_replace('','_',$files[$name]['name']);

     $filename = $rnd.$strip_name;
     $destination = $loc.$filename;

    if(move_uploaded_file($file[$name]['tmp_name'],$destination)) {
         $result[] = true;
    }else{
         $result[] =false;

    }

    // $result = move_uploaded_file($file[$name]['tmp_name'],$destination);


       return $result ;

   }

   function doadminRegister($dbconn,$input) {
     
       $hash = password_hash($input['password'],PASSWORD_BCRYPT);
     
       $stmt = $dbconn->prepare("INSERT INTO admin(firstname,lastname,email,hash)VALUES(:f,:l,:e,:h)");

        $data = [
          ":f" => $input['fname'],
          ":l" => $input['lname'],
          ":e" => $input['email'],
          ":h" => $hash
        ];
       
       $stmt->execute($data);
   }

   function doesEmailExist($dbconn,$email) {
       $result = false;

       $stmt = $dbconn->prepare("SELECT email FROM admin WHERE :e=email");
       $stmt -> bindParam(":e" , $email);
       $stmt->execute();

       $count = $stmt->rowCount();

       if($count > 0){
            $result = true;

       }
      
        return $result;
     }
      
      function displayErrors($err,$name) {
          $result="";

      	if(isset($err[$name])){
            $result = '<span class=err>'.$err[$name].'</span>';

      	}
      	  return $result;
      }




?>