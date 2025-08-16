<?php

// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

if($_POST){
  
    require "../../controller/registercontroller.php";

$username = htmlspecialchars(strip_tags(trim($_POST['username'])));
$email = htmlspecialchars(strip_tags(trim($_POST['email'])));;
$password = htmlspecialchars(strip_tags(trim($_POST['password'])));

$reg = new RegisterController($username,$email,$password);
echo $reg->regUser();
   

}

?>