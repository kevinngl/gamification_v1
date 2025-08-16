<?php

// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

if($_POST){
  
require "../../controller/logincontroller.php";
    $email = strip_tags(trim($_POST['email']));
    $password = strip_tags(trim($_POST['password']));
    
    $logn = new LoginController($email,$password);
    echo $logn->index();
}

?>