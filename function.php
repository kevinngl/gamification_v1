<?php
session_start();
// Check if the user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}



?>