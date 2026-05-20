<?php

session_start();
require '../config/connection.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$post_id = $_GET['id'];
$id_user = $_SESSION['id_user'];
$error = "";

$stmt = $conn->prepare("
    select posts.*, categories.cat_name, users.user_name
    from posts
    inner join categories on posts.category_id = categories.id_category
    left join users on posts.user_id = users.id_user
    where posts.id_post = ?
");
$stmt->execute([$post_id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rejection_reason = trim($_POST['rejection_reason']);

    if (empty($rejection_reason)) {
        $error = "Rejection reason is required.";
    } else {
        $stmt = $conn->prepare("
            update posts
            set status = 'rejected',
                approved_by = :approved_by,
                approved_at = now(),
                rejection_reason = :rejection_reason
            where id_post = :post_id
        ");

        $stmt->execute([
            ':approved_by' => $id_user,
            ':rejection_reason' => $rejection_reason,
            ':post_id' => $post_id
        ]);

        header("Location: dashboard.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reject Post - Tangier Vibes</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body>

<?php require '../includes/header.php'; ?>

<main class="dashboard_page">
    <section class="dashboard_head">
        <div>
            <span class="dashboard_label">
                <i class="fa-solid fa-xmark"></i>
                Reject Post
            </span>

            <h1><?= htmlspecialchars($post['title']); ?></h1>
            <p>Write the reason so the author knows what to fix.</p>
        </div>

        <a href="dashboard.php" class="add_post_btn">
            <i class="fa-solid fa-arrow-left"></i>
            Back
        </a>
    </section>

    <section class="form_box">
        <?php if (!empty($error)): ?>
            <p class="error_message"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form action="#" method="POST" class="post_form">
            <label for="rejection_reason">Rejection reason</label>
            <textarea id="rejection_reason" name="rejection_reason" placeholder="Explain what needs to be changed..." required><?= htmlspecialchars($post['rejection_reason'] ?? ''); ?></textarea>

            <button type="submit" class="add_post_btn">
                <i class="fa-solid fa-ban"></i>
                Reject Post
            </button>
        </form>
    </section>
</main>

<script src="../assets/js/main.js"></script>
</body>
</html>
