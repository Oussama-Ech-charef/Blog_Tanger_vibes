<?php

session_start();

require '../config/connection.php';

// check post id
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$post_id = $_GET['id'];
$id_user = $_SESSION['id_user'] ?? null;
$role = $_SESSION['role'] ?? null;

// get post
$stmt = $conn->prepare("
    select posts.*, categories.cat_name, users.user_name
    from posts
    inner join categories on posts.category_id = categories.id_category
    left join users on posts.user_id = users.id_user
    where posts.id_post = :id_post and posts.status = 'published'
");

$stmt->execute([
    ':id_post' => $post_id
    ]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    header('Location: index.php');
    exit;
}

// check permission
$can_view_unpublished = $role === 'admin' || ($id_user !== null && $post['user_id'] == $id_user);

if ($post['status'] !== 'published' && !$can_view_unpublished) {
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($post['title']) ?> - Tangier Vibes</title>
    
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
   
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/detail.css">
    
</head>
<body>


<?php require '../includes/header.php' ?>

    <div class="detail_container">

        <!-- category -->
        <div class="detail_category">
            <i class="fa-solid fa-layer-group"></i> TANGER / <span class="cat_name"><?= htmlspecialchars($post['cat_name']); ?></span>
        </div>


        <h1><?= htmlspecialchars($post['title']); ?></h1>

        <!-- post info -->
        <div class="icons">
            <span><i class="fa-solid fa-calendar-days"></i><?= date('M d, Y', strtotime($post['created_at'])); ?></span>
            <span><i class="fa-solid fa-circle-user"></i>By <?= htmlspecialchars($post['user_name'] ?? 'Admin'); ?></span>
            
        </div>

        <!-- rejection reason -->
        <?php if ($post['status'] === 'rejected' && !empty($post['rejection_reason'])): ?>
            <div class="social">
                <i class="fa-solid fa-ban"></i> Rejection reason:
                <?= htmlspecialchars($post['rejection_reason']); ?>
            </div>
        <?php endif; ?>

        <!-- image -->
        <img src="<?= htmlspecialchars($post['image']); ?>" width="400px" alt="<?= htmlspecialchars($post['title']); ?>">

        <!-- content -->
        <div class="content">
            <?= nl2br(htmlspecialchars($post['content'])); ?>
        </div>


        <!-- tags -->
        <div class="tags">
            <span><i class="fa-solid fa-hashtag"></i>Tangier</span>
            <span><i class="fa-solid fa-hashtag"></i>Nightlife</span>
            <span><i class="fa-solid fa-hashtag"></i>Beaches</span>
            <span><i class="fa-solid fa-hashtag"></i>Food</span>
            <span><i class="fa-solid fa-hashtag"></i>Culture</span>
        </div>


        <!-- share links -->
        <div class="social">
            <i class="fas fa-share-alt"></i> Share: <a href="#">Facebook</a> /<a href="#">Twitter</a> /<a href="#">WhatsApp</a>
        </div>

        <!-- map -->
        <?php if (!empty($post['map_link'])): ?>
        <div class="map_box">
            <iframe
                src="<?= htmlspecialchars($post['map_link']); ?>"
                width="100%"
                height="400"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
        <?php endif; ?>


        <!-- comments -->
        <div class="comments_posts">
            <div class="comment_title">
                <i class="fa-solid fa-comment-dots"></i> Comments
                <span >3</span>
            </div>
        </div>

        <div class="comments_list">
            
            <div class="comment_item">
                <div class="comment_header">
                    <span class="comment_name"><i class="fa-solid fa-circle-user"></i>Oussama</span>
                    <span class="comment_date"><i class="fa-solid fa-calendar-days"></i>May 16, 2026</span>
                </div>
                <div class="comment_text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore, saepe.
                </div>
            </div>

        </div>

        <div class="comment_form">
            <h3 class="comment_title">Leave a comment</h3>

            <form action="#" method="POST">
                <div class="form_name">
                    <label>Your name :</label>
                    <input type="text" name="name" placeholder="e.g., Ahmed or Fatima">
                </div>
                <div class="form_desc">
                    <label>Your message :</label>
                    <textarea name="message" placeholder="Share your vibe..."></textarea>
                </div>
                <button type="submit"><i class="fa-solid fa-paper-plane"></i> Post comment</button>
            </form>
        </div>


    </div>




    <script src="../assets/js/main.js"></script>
</body>

</html>
