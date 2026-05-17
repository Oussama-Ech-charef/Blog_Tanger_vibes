




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tangier Vibes</title>

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

            <h1>Login</h1>
            <p>Welcome back to Tangier Vibes.</p>

            <form action="#" method="POST">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Your password" required>

                <div class="options">
                    <label>
                        <input type="checkbox" name="remember">
                        Remember me
                    </label>
                    <a href="#">Forgot password?</a>
                </div>

                <button type="submit" class="btn">Login</button>
            </form>

            <p class="switch">Don't have an account? <a href="register.php">Register</a></p>
        </section>
    </main>

</body>
</html>
