<?php 

require "../../model/Login.php";

class LoginController extends Login{
  
    public $email;
    public $password;

    public $result;

    public function __construct($email,$password){
        
        $this->email = htmlspecialchars(strip_tags(trim($email)));
        $this->password = htmlspecialchars(strip_tags(trim($password)));
    }

    private function emptyInput(){
       
        if(empty ($this->email) || empty ($this->password)){

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
    public function index(){
        if(!$this->emptyInput() || !$this->invalidEmail()) {
            return json_encode(["message"=>"something is wrong"]);
        }
        else{
           
        
             if($this->loginUser($this->email,$this->password)){
               
               return json_encode(["data"=>[
                    "user_id"=>$this->stmt->user_id,
                    "username"=>$this->stmt->username,
                    "email"=> $this->stmt->email,
                    "role"=>$this->stmt->role,
                    "message"=>"successful",
                    "status"=>201

                ]
              ]);
              
             }else{
                return json_encode(["data"=>[
                   
                    "message"=>"Invalid Login Credentials",
                    "status"=>401

                ]
              ]);
             }
          
        }
       
    }

}

?>