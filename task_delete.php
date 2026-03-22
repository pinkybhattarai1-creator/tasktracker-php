<?php
require_once "auth.php";
require_once "db.php";

$user_id = $_SESSION["user_id"];
$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

$stmt = $conn->prepare("DELETE FROM tasks WHERE id=? AND user_id=?");
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();
$stmt->close();

header("Location: index.php");
exit();
?>
