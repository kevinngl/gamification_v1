<?php 
require "../../config/database.php";
Class Login extends Database{
    
   protected $stmt;
    protected function loginUser($email,$password){
        $sql = $this->connect()->prepare("SELECT * FROM users WHERE email = ?");
        $sql->execute([$email]);
       
        if( $this->stmt = $sql->fetch(PDO::FETCH_OBJ)){
            if(password_verify($password,$this->stmt->password)){
                session_start();
                session_regenerate_id();
                $_SESSION['loggedin'] = "loggedin";
                $_SESSION['user_id'] = $this->stmt->user_id;
                $_SESSION['username'] = $this->stmt->username;
                $_SESSION['email'] = $this->stmt->email;
                $_SESSION['role'] = $this->stmt->role;

                return $this->stmt;
            }
            else{
                return false;
            }
        }else{
            json_encode(["error"=>"an error occured"]);
            return false;
        }

    }


}

?>