<?php

// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require "../../model/User.php";


$cour = new User();
$check = $cour->UserRecord();

if($check){
    $post_arr = [];
    $post_arr['data']= array();

    while($row = $check->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $post_item = [
            'user'=>trim($user_id),
            'course_id'=>trim($course_id),
            'title'=>htmlentities(strip_tags(trim($name))),
            'image'=>$image,
            'coin'=>$coin,
            'challenge'=>$challenge,
            'username'=>$username,
            'earning'=>$earnings,
            'xps_coin'=>$xps_coin,
            'score'=>$score,
            'win'=>$win
        ];

        array_push($post_arr['data'],$post_item);

    }
    //Turn to json
    echo json_encode($post_arr);

}else{
    echo json_encode(["message"=>"No items found"]);
}
?>