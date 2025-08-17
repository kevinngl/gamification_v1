<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require "../../model/Quiz.php";

if (isset($_GET['user']) && isset($_GET['course'])) {
    $userId = intval($_GET['user']);
    $courseId = intval($_GET['course']);

    $quizModel = new Quiz();
    $attempt = $quizModel->getQuizAttempt($userId, $courseId);

    if ($attempt) {
        echo json_encode([
            "status" => "done",
            "score" => $attempt['score'],
            "result" => $attempt['result'],
            "coin_earned" => $attempt['coin_earned'],
            "completed_at" => $attempt['completed_at']
        ]);
    } else {
        echo json_encode([
            "status" => "not_attempted"
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Missing parameters"
    ]);
}
