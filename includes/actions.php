<?php

session_start();
require '../config/connection.php';

// check login
if (!isset($_SESSION['id_user'])) {
    header("Location: ../pages/login.php");
    exit();
}

// check admin
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../pages/dashboard.php");
    exit();
}

// check action and post id
if (!isset($_GET['action']) || !isset($_GET['id'])) {
    header("Location: ../pages/dashboard.php");
    exit();
}

$action = $_GET['action'];
$post_id = $_GET['id'];
$id_user = $_SESSION['id_user'];

// approve post
if ($action === 'approve') {
    $stmt = $conn->prepare("
        update posts
        set status = 'published',
            approved_by = ?,
            approved_at = now(),
            rejection_reason = null
        where id_post = ? and status = 'pending'
    ");
    $stmt->execute([$id_user, $post_id]);
}

header("Location: ../pages/dashboard.php");
exit();
