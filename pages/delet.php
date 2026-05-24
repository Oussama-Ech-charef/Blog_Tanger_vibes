<?php

session_start();
require '../config/connection.php';

// check login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}

// check post id
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$post_id = $_GET['id'];
$id_user = $_SESSION['id_user'];
$role = $_SESSION['role'];

// delete post
if ($role === 'admin') {
    $stmt = $conn->prepare("delete from posts where id_post = ?");
    $stmt->execute([$post_id]);
} else {
    $stmt = $conn->prepare("delete from posts where id_post = ? and user_id = ?");
    $stmt->execute([$post_id, $id_user]);
}

header("Location: dashboard.php");
exit();
