<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require "../../model/Quiz.php";

if(isset($_GET['course_id']) && !empty($_GET['course_id'])){
    $course_id = (int)$_GET['course_id'];

    $quizModel = new Quiz();
    $total = $quizModel->countQuizByCourseId($course_id);

    echo json_encode([
        "status" => "success",
        "total" => $total
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Course ID is missing"
    ]);
}
