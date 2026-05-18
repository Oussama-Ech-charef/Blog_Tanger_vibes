



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

            <h1>Welcome, oussama</h1>

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
            <strong>13</strong>
        </div>

        <div class="stat_card">
            <span>Published</span>
            <strong>10</strong>
        </div>

        <div class="stat_card">
            <span>Pending</span>
            <strong>1</strong>
        </div>
    </section>

    <section class="posts_box">
        <div class="box_head">
            <h2>Posts</h2>
        </div>

        
            <div class="table_wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>

                            
                                <th>Author</th>
                           

                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                       
                            <tr>
                                <td>test</td>
                                <td>cate_name</td>

                                
                                    <td>oussama</td>
                             

                                <td>
                                    <span class="status">
                                        published
                                    </span>
                                </td>

                                <td>2026</td>

                                <td>
                                    <a href="detail.php" class="table_link">
                                        View
                                    </a>
                                </td>
                            </tr>
                       
                    </tbody>
                </table>
            </div>
       
            <p class="empty_text">No posts yet.</p>
        
    </section>

</main>

<script src="../assets/js/main.js"></script>
</body>
</html>