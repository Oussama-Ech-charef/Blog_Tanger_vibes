

<?php 

session_start();

require  '../config/connection.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();

}



$id_user = $_SESSION['id_user'];

$user_name = $_SESSION['user_name'];
$role = $_SESSION['role'];



if ($role === 'admin') {
    $stmt = $conn->prepare("
        select posts.*, categories.cat_name, users.user_name
        from posts
        inner join categories on posts.category_id = categories.id_category
        left join users on posts.user_id = users.id_user
        order by posts.created_at desc
    ");
    $stmt->execute();
}else {
    $stmt = $conn->prepare("
        select posts.*, categories.cat_name
        from posts
        inner join categories on posts.category_id = categories.id_category
        where posts.user_id = ?
        order by posts.created_at desc
    ");
    $stmt->execute([$id_user]);
}

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);


$total_posts = count($posts);

$pending_posts = 0;
$published_posts = 0;



foreach ($posts as $post) {
    if ($post['status'] === 'pending') {
        $pending_posts++;
    }

    if ($post['status'] === 'published') {
        $published_posts++;
    }
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Tangier Vibes</title>

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
                <i class="fa-solid fa-gauge"></i>
                Dashboard
            </span>

            <h1>Welcome, <?= htmlspecialchars($user_name) ?></h1>

            <p>
                Manage your posts and track their publishing status.
            </p>
        </div>

        <a href="#" class="add_post_btn">
            <i class="fa-solid fa-plus"></i>
            Add Post
        </a>
    </section>

    <section class="stats_grid">
        <div class="stat_card">
            <span>Total Posts</span>
            <strong><?= $total_posts; ?></strong>
        </div>

        <div class="stat_card">
            <span>Published</span>
            <strong><?= $published_posts; ?></strong>
        </div>

        <div class="stat_card">
            <span>Pending</span>
            <strong><?= $pending_posts; ?></strong>
        </div>
    </section>

    <section class="posts_box">
        <div class="box_head">
            <h2>Posts</h2>
        </div>

        <?php if (!empty($posts)): ?>
            <div class="table_wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>

                            <?php if ($role === 'admin'): ?>
                                <th>Author</th>
                           <?php endif; ?>

                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                       <?php foreach ($posts as $post): ?>
                            <tr>
                                <td><?= htmlspecialchars($post['title']); ?></td>
                                <td><?= htmlspecialchars($post['cat_name']); ?></td>

                                <?php if ($role === 'admin'): ?>
                                    <td><?= htmlspecialchars($post['user_name'] ?? 'admin'); ?></td>
                                <?php endif; ?>

                                <td>
                                    <span class="status <?= htmlspecialchars($post['status']); ?>">
                                        <?= htmlspecialchars($post['status']); ?>
                                    </span>
                                </td>

                                <td><?= date('M d, Y', strtotime($post['created_at'])); ?></td>

                                <td>
                                    <a href="detail.php?id=<?= $post['id_post']; ?>" class="table_link">
                                        View
                                    </a>
                                </td>
                            </tr>
                       <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
       <?php else: ?>
            <p class="empty_text">No posts yet.</p>
        <?php endif; ?>
    </section>

</main>

<script src="../assets/js/main.js"></script>
</body>
</html>