<?php

// Headers
if($_POST){

$course = (int)trim($_POST['course_id']);

include "../../model/Course.php";
$create = new Course();

        if($create->deletecourse($course)){

            echo json_encode(["message"=>"deleted successfully","status"=>401]);

        }
        else{

            echo json_encode(["message"=>"unable to delete","status"=>401]);

        }

}else{
   
}



?>