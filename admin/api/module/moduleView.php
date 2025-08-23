<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require "../../config/database.php";
require "../../model/Module.php";

$courseId = isset($_GET['course']) ? $_GET['course'] : die(json_encode([
    "status" => "error",
    "message" => "Course ID not provided in GET request."
]));

$database = new Database();
$db = $database->connect();

$cour = new Module($db);

// 1. Fetch course details directly
$courseSql = "SELECT course_id, name, description, image, link, material, created_at 
              FROM course 
              WHERE course_id = :id 
              LIMIT 1";
$stmt = $db->prepare($courseSql);
$stmt->bindParam(":id", $courseId);
$stmt->execute();

if ($stmt->rowCount() === 0) {
    echo json_encode([
        "status" => "no_course",
        "message" => "Course not found."
    ]);
    exit;
}

$courseRow = $stmt->fetch(PDO::FETCH_ASSOC);

$courseDetails = [
    "course_name" => html_entity_decode(strip_tags(trim($courseRow['name'] ?? ''))),
    "course_description" => html_entity_decode(nl2br(strip_tags(trim($courseRow['description'] ?? '')))),
    "poster" => $courseRow['image'] ?? '',
    "course_link" => html_entity_decode($courseRow['link'] ?? ''),
    "course_material" => $courseRow['material'] ?? '',
    "posted" => $courseRow['created_at'] ?? ''
];

// 2. Fetch modules (may return 0 rows)
$check = $cour->CModule($courseId);
$modules = [];

if ($check && $check->rowCount() > 0) {
    while ($row = $check->fetch(PDO::FETCH_ASSOC)) {
        $modules[] = [
            "module_id" => trim($row['module_id']),
            "course_id" => trim($row['course_id']),
            "module_name" => html_entity_decode(strip_tags(trim($row['module_name'] ?? ''))),
            "module_description" => html_entity_decode(nl2br(strip_tags(trim($row['module_description'] ?? '')))),
        ];
    }
}

// 3. Return unified response
echo json_encode([
    "status" => "success",
    "course_details" => $courseDetails,
    "data" => $modules
]);
