<?php

session_start();
require '../config/connection.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: ../pages/login.php");
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../pages/dashboard.php");
    exit();
}

if (!isset($_GET['action']) || !isset($_GET['id'])) {
    header("Location: ../pages/dashboard.php");
    exit();
}

$action = $_GET['action'];
$post_id = $_GET['id'];
$id_user = $_SESSION['id_user'];

if ($action === 'approve') {
    $stmt = $conn->prepare("
        update posts
        set status = 'published',
            approved_by = ?,
            approved_at = now(),
            rejection_reason = null
        where id_post = ?
    ");
    $stmt->execute([$id_user, $post_id]);
}

header("Location: ../pages/dashboard.php");
exit();
