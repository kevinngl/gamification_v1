<?php

// Headers
if($_SERVER["REQUEST_METHOD"]=== "POST"){

$title = $_POST['title'];
$course = $_POST['course'];
$content = $_POST['content'];

include "../../controller/modulecontroller.php";
$create = new ModuleController();
$create->title = $title;
$create->content = $content;
$create->course_id = $course;


echo $create->Create();
}else{
    echo "error";
}
?>