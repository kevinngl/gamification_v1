<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require "../../model/Quiz.php";

// Pastikan ada parameter course_id dari request GET
if(isset($_GET['course_id']) && !empty($_GET['course_id'])){
    $course_id = (int)$_GET['course_id']; // Ambil dan bersihkan course_id

    // Inisialisasi model
    $quizModel = new Quiz();
    // Panggil method baru untuk mengambil kuis berdasarkan course_id
    $quizzes = $quizModel->getQuizByCourseId($course_id); 

    if($quizzes){
        // Jika ada kuis
        echo json_encode(["data" => $quizzes]);
    } else {
        // Jika tidak ada kuis
        echo json_encode(["data" => [], "message" => "No quizzes found for this course"]);
    }
} else {
    // Jika parameter course_id tidak ada
    echo json_encode(["message" => "Course ID is missing"]);
}
?>