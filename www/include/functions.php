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





?>