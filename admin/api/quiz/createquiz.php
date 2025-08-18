<?php

// Headers
header('Content-Type: application/json');


if ($_POST) {
    require "../../controller/quizcontroller.php";
    $quiz = new QuizController();
    $quiz->question  = strip_tags(trim($_POST['question'] ?? ''));
    $quiz->course_id = (int) strip_tags(trim($_POST['course'] ?? 0));
    $quiz->option_a = strip_tags(trim($_POST['option_a'] ?? ''));
    $quiz->option_b = strip_tags(trim($_POST['option_b'] ?? ''));
    $quiz->option_c = strip_tags(trim($_POST['option_c'] ?? ''));
    $quiz->option_d = strip_tags(trim($_POST['option_d'] ?? ''));
    $quiz->answer = strip_tags(trim($_POST['answer'] ?? ''));

    echo $quiz->Create();
} else {
    echo json_encode(["message" => "invalid request method", "status" => 405]);
}
