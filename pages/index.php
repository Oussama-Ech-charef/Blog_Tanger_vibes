

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tangier Vibes - Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/home.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
</head>
<body>


<?php require '../includes/header.php'; ?>

        <section class="hero_section">
            <img src="../assets/images/home.jpg"  alt="Tanger Vibes" loading="lazy">
            <div class="hero_shadow"></div>


            <div class="hero_content">
               
                <p class="hero_label">WELCOME TO YOUR GATEWAY TO AFRICA</p>
                <h1 class="hero_title">Experience the Magic<br> of <span class="hero_highlight">Tangier</span></h1>

                <p class="hero_desc">Discover hidden beaches, legendary cafes, exquisite<br>restaurants, and historic landmarks in the Pearl of the North.</p>
                
                <div class="hero_btns">

                    <a href="explore.php" class="btn_explor">
                        Start Exploring
                    </a>

                </div>
            </div>
        </section>


        <section class="latest_section">
            <div class="section_header">
                <h2 class="title">Latest Places</h2>
                <p class="description">The newest additions to TangierVibes</p>
            </div>



            <div class="grid_place">

                <a href="detail.php" class="card_place">
                    <img src="../assets/images/home.jpg" alt="Tanger Vibes">
                    <div class="card_content">

                        <span class="category"> <i class="fa-solid fa-layer-group"></i> Tangier Spot</span>
                        <h3 class="title">Plage Achakare</h3>
                        <p class="location"> <i class="fa-solid fa-location-dot"></i> Tangier, Morocco</p>
                        <span class="btn">Explore <i class="fa-solid fa-arrow-right"></i></span>
                    </div>
                </a>
                <a href="" class="card_place">
                    <img src="../assets/images/home.jpg" alt="Tanger Vibes">
                    <div class="card_content">

                        <span class="category"> <i class="fa-solid fa-layer-group"></i> Tangier Spot</span>
                        <h3 class="title">Plage Achakare</h3>
                        <p class="location"> <i class="fa-solid fa-location-dot"></i> Tangier, Morocco</p>
                        <span class="btn">Explore <i class="fa-solid fa-arrow-right"></i></span>
                    </div>
                </a>
                <a href="" class="card_place">
                    <img src="../assets/images/home.jpg" alt="Tanger Vibes">
                    <div class="card_content">

                        <span class="category"> <i class="fa-solid fa-layer-group"></i> Tangier Spot</span>
                        <h3 class="title">Plage Achakare</h3>
                        <p class="location"> <i class="fa-solid fa-location-dot"></i> Tangier, Morocco</p>
                        <span class="btn">Explore <i class="fa-solid fa-arrow-right"></i></span>
                    </div>
                </a>


            </div>

            


                <div class="footer_section">
                    <a href="#" class="view_explor">
                        View All Places <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
        </section>


<?php require '../includes/footer.php' ?>
    <script src="../assets/js/main.js"></script>
</body>
</html>