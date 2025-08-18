<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quiz_id'])) {

    $quizId = (int) trim($_POST['quiz_id']);

    include "../../model/Quiz.php";
    $quiz = new Quiz();

    if ($quiz->deletequiz($quizId)) {
        echo json_encode(["success" => true, "message" => "Deleted successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Unable to delete"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}
