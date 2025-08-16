<?php

// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require "../../model/User.php";


$cour = new User();
$check = $cour->allUser();

if($check){
    $post_arr = [];
    $post_arr['data']= array();

    while($row = $check->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $post_item = [
            'user'=>trim($user_id),
            'email'=>$email,
            'username'=>$username,
            'earnings'=>$earnings,
            'xps_coin'=>$xps_coin
        ];

        array_push($post_arr['data'],$post_item);

    }
    //Turn to json
    echo json_encode($post_arr);

}else{
    echo json_encode(["message"=>"No items found"]);
}
?>