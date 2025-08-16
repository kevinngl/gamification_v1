<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require "../../model/User.php";

    $xps = (int)strip_tags(trim($_POST['xps']));
    $user = strip_tags(trim($_POST['user']));
    
    $exp = new User();
    $result = $exp->Xps($xps, $user);
    
    // Check if the update was successful
    if ($result !== false) {
        // Return a success response
        echo $result;
    } else {
        // Return an error response
        echo "Error updating XPS";
    }
} else {
    // Return an error response for invalid or missing data
    echo json_encode(['status' => 400, 'message' => 'Invalid data or request method']);
}
?>
