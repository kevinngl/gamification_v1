<?php

// Headers
if($_POST){

    $title = isset($_POST['name']) ? $_POST['name'] : '';
    $desc = isset($_POST['description']) ? html_entity_decode($_POST['description']) : '';
    $im = isset($_FILES['image']) ? $_FILES['image'] : null;
    $coin = isset($_POST['coin']) ? trim($_POST['coin']) : '';
    $link = isset($_POST['link']) ? trim($_POST['link']) : '';
    $material = isset($_FILES['material']) ? $_FILES['material'] : null;
    $challenge = isset($_POST['challenge']) && $_POST['challenge'] === 'on' ? 'on' : 'off';
    $id = isset($_POST['customid']) ? (int)trim($_POST['customid']) : 0;
    
include "../../controller/coursecontroller.php";
$create = new CourseController();
$create->name = $title;
$create->description = $desc;
$create->image = $im;
$create->coin = $coin;
$create->link = $link;
$create->material= $material;
$create->challenge = $challenge;
$create->id = $id;

echo $create->Update();
}else{
    echo json_encode(["message"=>"error","status"=>401]);
}



?>