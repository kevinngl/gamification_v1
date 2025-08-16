<?php 

require "../../model/Register.php";
class RegisterController extends Register{
    public $username;
    public $email;
    public $password;

    public $result;

    public function __construct($username,$email,$password){
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    private function checkUsername(){
       
        if(!preg_match("/^[a-zA-Z0-9]*$/",$this->username)){
            $this->result = false;
        }else{
            $this->result = true;
        }

        return $this->result;
    }
    private function emptyInput(){
       
        if(empty($this->username) || empty ($this->email) || empty ($this->password)){

            $this->result = false;
        }else{
            $this->result = true;
        }

        return $this->result;
    }

    private function invalidEmail(){
       
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            
            $this->result = false;
        }else{
            $this->result = true;
        }

        return $this->result;
    }

    public function regUser(){
        if(!$this->emptyInput()|| !$this->invalidEmail() || !$this->checkUsername()){
            return json_encode(["message" => "incorrect field input"]);
        }else if($this->checkEmail($this->email)){
            return json_encode(["message" => "Email is already taken"]);
        }else{
             $this->register($this->username,$this->email,$this->password);
             return json_encode(["message"=>"successful","status"=>http_response_code(201)]);
        }
    }

}



?>