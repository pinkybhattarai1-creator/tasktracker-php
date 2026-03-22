<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "task_app_db";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
  die("DB Connect Failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
?>
