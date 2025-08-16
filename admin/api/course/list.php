<?php

// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require "../../model/Course.php";


$cour = new Course();
$check = $cour->getCourse();

if($check){
    $post_arr = [];
    $post_arr['data']= array();

    while($row = $check->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $post_item = [
            'course_id'=>trim($course_id),
            'title'=>htmlentities(strip_tags(trim($name))),
            'coin'=>trim($name),
            'challenge'=>trim($challenge),
            'content'=>html_entity_decode(trim($description)),
            'link'=>trim($link),
            'material'=>strip_tags(trim($material))
          
        ];

        array_push($post_arr['data'],$post_item);

    }
    //Turn to json
    echo json_encode($post_arr);

}else{
    echo json_encode(["message"=>"No items found"]);
}
?>