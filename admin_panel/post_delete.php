<?php
session_start();
require "../config/config.php";
if (empty($_SESSION['user_id']) || empty($_SESSION['logged_in'])){
    header("location:login.php");
}

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM posts WHERE id=:id");
$result = $stmt->execute([':id'=>$id]);
if ($result){
    $_SESSION['status'] = "Post is Deleted";
    header("location:post_list.php");
}