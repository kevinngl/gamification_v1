<?php

// Headers
if($_POST){

        $course = (int)trim($_POST['module_id']);

        include "../../model/Module.php";
        $create = new Module();

        if($create->deletemodule($course)){
            echo json_encode(["message"=>"deleted successfully","status"=>201]);
        }
        else{
            echo json_encode(["message"=>"unable to delete","status"=>401]);
        }

}else{
   
}



?>