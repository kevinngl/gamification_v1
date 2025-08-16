<?php

// Headers
if($_POST){

$title = $_POST['name'];
$desc = $_POST['description'];
$im =  $_FILES['image'];
$coin = $_POST['coin'];
$link = $_POST['link'];
$material = $_FILES['material'];
// $challenge = $_POST['challenge'];
$challenge = isset($_POST['challenge']) ? 1 : 0;
include "../../controller/coursecontroller.php";
$create = new CourseController();
$create->name = $title;
$create->description = $desc;
$create->image = $im;
$create->coin = $coin;
$create->link = $link;
$create->material= $material;
$create->challenge = $challenge;

echo $create->Create();
}else{
    echo json_encode(["message"=>"error","status"=>401]);
}



?>