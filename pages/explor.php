<?php

require '../config/connection.php';

$stmt = $conn->prepare("
        select posts.*, categories.cat_name, users.user_name
        from posts
        inner join categories on posts.category_id = categories.id_category
        left join users on posts.user_id = users.id_user
        where posts.status = 'published'
        order by posts.created_at desc
");

$stmt->execute();

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Tangier Vibes</title>
    
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
   
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/explor.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    
</head>
<body>

        <?php require '../includes/header.php' ?>
        
        <main class="explore_page">

            <section class="explore_head">
                <span class="explore_label">
                    <i class="fa-solid fa-compass"></i>
                    Explore Tangier
                </span>

                <h1>Discover all posts</h1>

                <p>
                    Explore the best places, beaches, food spots, culture, and hidden vibes around Tangier.
                </p>
            </section>

            <section class="explore_filters">
                <button class="active">All</button>
                <button>Beach</button>
                <button>Food</button>
                <button>Culture</button>
                <button>Nature</button>
                <button>City</button>
            </section>

            <section class="grid_place">

                <?php if (!empty($posts)): ?>
                    <?php foreach ($posts as $post): ?>

                        <a href="detail.php?id=<?= $post['id_post']; ?>" class="card_place">
                            <img src="<?= htmlspecialchars($post['image']); ?>" alt="<?= htmlspecialchars($post['title']); ?>" loading="lazy">

                            <div class="card_content">

                                <span class="category">
                                    <i class="fa-solid fa-layer-group"></i>
                                    <?= htmlspecialchars($post['cat_name']); ?>
                                </span>

                                <h3 class="title">
                                    <?= htmlspecialchars($post['title']); ?>
                                </h3>

                                <p class="location">
                                    <i class="fa-solid fa-user"></i>
                                    By <?= htmlspecialchars($post['user_name'] ?? 'Admin'); ?>
                                </p>

                                <p class="location">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <?= date('M d, Y', strtotime($post['created_at'])); ?>
                                </p>

                                <span class="btn">
                                    Read More <i class="fa-solid fa-arrow-right"></i>
                                </span>
                            </div>
                        </a>

                    <?php endforeach; ?>
                <?php else: ?>

                    <p class="description">No published places yet.</p>

                <?php endif; ?>


            </section>

        </main>
        
        
        
        <?php require '../includes/footer.php' ?>
        
    <script src="../assets/js/main.js"></script>

</body>
</html>
