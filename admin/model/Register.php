<?php
require "../../config/database.php";
class Register extends Database{
    protected function checkEmail($email){
        $sql = $this->connect()->prepare("SELECT email FROM users WHERE email = ?");
        $sql->execute([$email]);
        
        if($sql->fetch(PDO::FETCH_OBJ)){
         return true;
        }
     }
    protected function register($username,$email, $password)

    {
        $password_hash = password_hash($password,PASSWORD_DEFAULT);
        $sql = $this->connect()->prepare("INSERT  INTO users(username,email,password) VALUES (?,?,?)");
         if($sql->execute([$username,$email,$password_hash])){
            return true;
        }else{
    
            throw new Exception ("User can not be created");
        }


     }
 
}

?>