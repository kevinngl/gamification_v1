<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require "../../model/User.php";

    $user = strip_tags(trim($_POST['user'] ?? ''));
    $course = strip_tags(trim($_POST['course'] ?? ''));
    $win = strip_tags(trim($_POST['win'] ?? ''));   // gold/diamond/bronze/stone
    $score = strip_tags(trim($_POST['score'] ?? '0'));
    $wincoin = strip_tags(trim($_POST['wincoin'] ?? '0'));

    if (empty($user) || empty($course)) {
        http_response_code(400);
        echo json_encode(['status' => 400, 'message' => 'Missing user or course']);
        exit;
    }

    $coin = new User();

    // Step 1: Update coins in user table
    $result = $coin->Coin($wincoin, $user);
    if ($result === false) {
        http_response_code(500);
        echo json_encode(['status' => 500, 'message' => 'Error updating user coins']);
        exit;
    }

    $exists = $coin->checkUserCourseExistence($user, $course);
    if (!$exists) {
        $resp = $coin->insertUserCourseEarning($user, $course, $win, $score);
    } else {
        $resp = $coin->updateUserCourseEarning($user, $course, $win, $score);
    }

    $quizModel = new Quiz();
    $attempt = $quizModel->insertQuizAttempt($user, $course, $score, $win, $wincoin);

    if ($attempt === false) {
        http_response_code(500);
        echo json_encode(['status' => 500, 'message' => 'Failed to record quiz attempt']);
        exit;
    }

    // Step 4: Respond
    echo json_encode([
        'status' => 200,
        'message' => 'User data updated successfully',
        'scoreUpdate' => $resp,
        'quizAttempt' => $attempt
    ]);
    exit;

} else {
    http_response_code(400);
    echo json_encode(['status' => 400, 'message' => 'Invalid request method']);
    exit;
}
