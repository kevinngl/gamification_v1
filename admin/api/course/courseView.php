<?php

// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require "../../model/Course.php";


$cour = new Course();
$check = $cour->Mcourse();

if($check){
    $post_arr = [];
    $post_arr['data']= array();

    while($row = $check->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $post_item = [
            'course_id'=>trim($course_id),
            'title'=>html_entity_decode(strip_tags(trim($name))),
            'description'=>html_entity_decode(nl2br(strip_tags($description))),
            'image'=>$image,
            'coin'=>$coin,
            'challenge'=>$challenge,
            'module'=>$num
        ];

        array_push($post_arr['data'],$post_item);

    }
    //Turn to json
    echo json_encode($post_arr);

}else{
    echo json_encode(["message"=>"No items found"]);
}
?>