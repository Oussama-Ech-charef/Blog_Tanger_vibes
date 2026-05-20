<?php

session_start();
require '../config/connection.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$post_id = $_GET['id'];
$id_user = $_SESSION['id_user'];
$role = $_SESSION['role'];
$error = "";

$cat_stmt = $conn->prepare("select * from categories order by cat_name asc");
$cat_stmt->execute();
$categories = $cat_stmt->fetchAll(PDO::FETCH_ASSOC);

if ($role === 'admin') {
    $stmt = $conn->prepare("select * from posts where id_post = ?");
    $stmt->execute([$post_id]);
} else {
    $stmt = $conn->prepare("select * from posts where id_post = ? and user_id = ?");
    $stmt->execute([$post_id, $id_user]);
}

$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $category_id = $_POST['category_id'];
    $content = trim($_POST['content']);
    $map_link = trim($_POST['map_link']);
    $image = $post['image'];

    if (preg_match('/src="([^"]+)"/', $map_link, $matches)) {
        $map_link = $matches[1];
    }

    if (!empty($_FILES['image']['name'])) {
        $upload_dir = "../assets/uploads/";

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $image_name = "post_" . time() . "_" . $_FILES['image']['name'];
        $image = $upload_dir . $image_name;

        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    if (empty($title) || empty($category_id) || empty($content)) {
        $error = "Title, category and content are required.";
    } else {
            if ($role === 'admin') {
            $stmt = $conn->prepare("
                update posts
                set category_id = :category_id,
                    title = :title,
                    image = :image,
                    content = :content,
                    map_link = :map_link
                where id_post = :post_id
            ");

            $stmt->execute([
                ':category_id' => $category_id,
                ':title' => $title,
                ':image' => $image,
                ':content' => $content,
                ':map_link' => $map_link,
                ':post_id' => $post_id
            ]);
        } else {
            $stmt = $conn->prepare("
                update posts
                set category_id = :category_id,
                    title = :title,
                    image = :image,
                    content = :content,
                    map_link = :map_link
                where id_post = :post_id and user_id = :user_id
            ");

            $stmt->execute([
                ':category_id' => $category_id,
                ':title' => $title,
                ':image' => $image,
                ':content' => $content,
                ':map_link' => $map_link,
                ':post_id' => $post_id,
                ':user_id' => $id_user
            ]);
        }

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
    <title>Edit Post - Tangier Vibes</title>
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
                <i class="fa-solid fa-pen"></i>
                Edit Post
            </span>

            <h1>Edit post</h1>
            <p>Update your post information.</p>
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

        <form action="#" method="POST" class="post_form" enctype="multipart/form-data">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($post['title']); ?>" required>

            <label for="category_id">Category</label>
            <select id="category_id" name="category_id" required>
                <option value="">Choose category</option>

                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id_category']; ?>" <?= $category['id_category'] == $post['category_id'] ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($category['cat_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="image">Image</label>
            <input type="file" id="image" name="image" accept="image/*">

            <?php if (!empty($post['image'])): ?>
                <p class="empty_text">Current image: <?= htmlspecialchars($post['image']); ?></p>
            <?php endif; ?>

            <label for="map_link">Map link</label>
            <input type="text" id="map_link" name="map_link" value="<?= htmlspecialchars($post['map_link']); ?>">

            <label for="content">Content</label>
            <textarea id="content" name="content" required><?= htmlspecialchars($post['content']); ?></textarea>

            <button type="submit" class="add_post_btn">
                <i class="fa-solid fa-floppy-disk"></i>
                Save Changes
            </button>
        </form>
    </section>
</main>

<script src="../assets/js/main.js"></script>
</body>
</html>