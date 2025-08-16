<?php

// Headers
if($_POST){

$course = (int)trim($_POST['quiz_id']);

include "../../model/Quiz.php";
$create = new Quiz();



        if($create->deletequiz($course)){
            echo json_encode(["message"=>"deleted successfully","status"=>201]);
        }
        else{
            echo json_encode(["message"=>"unable to delete","status"=>401]);
        }
}else{
   
}



?>