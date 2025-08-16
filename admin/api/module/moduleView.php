<?php

// Headers
error_reporting(E_ALL); 
ini_set('display_errors', 1); 
header('Content-Type: application/json'); // Cukup sekali ini saja

header('Access-Control-Allow-Origin: *'); // Ini bagus untuk CORS jika diperlukan


// Pastikan database.php di-require duluan karena Module extends Database
require "../../config/database.php"; // <--- TAMBAHKAN BARIS INI
require "../../model/Module.php";

// Dapatkan course_id dari parameter GET
// Ini PENTING karena CModule() sekarang butuh parameter ini
$courseId = isset($_GET['course']) ? $_GET['course'] : die(json_encode(["status" => "error", "message" => "Course ID not provided in GET request."]));

// Inisialisasi koneksi database
$database = new Database();
$db = $database->connect();

// Inisialisasi objek Module dengan koneksi database
$cour = new Module($db); // <--- Teruskan objek koneksi ke konstruktor Module

// Panggil CModule() dengan course_id
$check = $cour->CModule($courseId); // <--- Teruskan $courseId di sini

if($check){
    $post_arr = [];
    $post_arr['data']= array();
    $post_arr['status'] = "success"; // Tambahkan status sukses

    $courseDetailsAdded = false; // Flag untuk memastikan detail kursus utama hanya ditambahkan sekali

    while($row = $check->fetch(PDO::FETCH_ASSOC)){
        // Gunakan $row['kolom_name'] secara eksplisit untuk menghindari konflik nama dan kebingungan
        // Tidak disarankan menggunakan extract($row) ketika ada nama kolom yang sama dari JOIN
        
        // Kita hanya perlu detail kursus utama dari baris pertama modul
        // Modul-modul selanjutnya hanya akan menambahkan daftar modul
        if (!$courseDetailsAdded) {
            $post_arr['course_details'] = [
                'course_name' => html_entity_decode(strip_tags(trim($row['name']))), // Nama kursus dari tabel course
                'course_description' => html_entity_decode(nl2br(strip_tags(trim($row['description'])))), // Deskripsi kursus dari tabel course
                'poster' => $row['poster'], // Alias dari course.image
                'course_link' => html_entity_decode($row['link']), // Dari course.link
                'course_material' => $row['material'], // Dari course.material
                'posted' => $row['posted'] // Dari course.created_at
            ];
            $courseDetailsAdded = true;
        }

        $post_item = [
            'module_id'=> trim($row['module_id']), // Ini adalah ID dari tabel module
            'course_id'=>trim($row['course_id']), // Ini adalah course_id dari tabel module
            'module_name'=>html_entity_decode(strip_tags(trim($row['name']))), // Ini adalah nama dari tabel module (jika di SELECT module.*)
            'module_description'=>html_entity_decode(nl2br(strip_tags(trim($row['description'])))), // Ini adalah deskripsi dari tabel module (jika di SELECT module.*)
            // 'title' dan 'content' tidak ada di SELECT statement kamu berdasarkan Module.php
            // Jadi baris ini HARUS dihapus atau diganti dengan kolom yang benar dari tabel 'module' jika ada.
            // Contoh jika 'name' adalah judul modul dan 'description' adalah kontennya:
            // 'title' => html_entity_decode(strip_tags(trim($row['name']))), // jika nama modul dianggap sebagai judul
            // 'content' => html_entity_decode(nl2br(strip_tags(trim($row['description'])))), // jika deskripsi modul dianggap sebagai konten

            // Kolom dari tabel course sudah diambil di 'course_details' di atas
            // Jika kamu ingin detail kursus ini muncul di setiap item modul, kamu bisa menyertakannya lagi.
            // Tapi biasanya detail kursus ditampilkan di atas daftar modul.
            // 'link' => html_entity_decode($row['link']), 
            // 'material' => $row['material'], 
            // 'poster' => $row['poster'], 
            // 'posted' => $row['posted'] 
        ];

        array_push($post_arr['data'],$post_item); // Array 'data' berisi daftar modul
    }
    //Turn to json
    echo json_encode($post_arr);

}else{
    // Jika $check bernilai false (error SQL) atau tidak ada hasil
    echo json_encode(["status" => "no_data", "message"=>"No modules found for this course or SQL error."]);
}
?>