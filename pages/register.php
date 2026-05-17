





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Tangier Vibes</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>

    <main class="login_and_register">
        <section class="card">
            <a href="index.php" class="logo">
                <i class="fa-solid fa-compass"></i>
                Tangier <span>Vibes</span>
            </a>

            <h1>Register</h1>
            <p>Create your Tangier Vibes account.</p>

            <form action="#" method="POST">
                <label for="name">Full name</label>
                <input type="text" id="name" name="name" placeholder="Your name" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Create password" required>

                <button type="submit" class="btn">Create account</button>
            </form>

            <p class="switch">Already have an account? <a href="login.php">Login</a></p>
        </section>
    </main>

</body>
</html>
