<?php 

session_start();


require '../config/connection.php';



$error = "";

// success message from register
$success = $_SESSION['success'] ?? "";



unset($_SESSION['success']);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // get form values
    $email = trim($_POST['email']);
    $password = $_POST['password'];


    // validation
    if (empty($email) || empty($password)) {

        $error = "All fields are required.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Invalid email format.";

    } else {

        // get user
        $stmt = $conn->prepare("select * from users where email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        // check password
        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);

            // create session
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['role'] = $user['role'];



            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Email or password is incorrect.";
        }
    }
}



?>









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

        <!-- login card -->
        <section class="card">

            <a href="index.php" class="logo">
                <i class="fa-solid fa-compass"></i>
                Tangier <span>Vibes</span>
            </a>

            <h1>Login</h1>

            <p>Welcome back to Tangier Vibes.</p>

                    <!-- messages -->
                    <?php if (!empty($success)): ?>
                        <p class="success_message"><?= $success; ?></p>
                    <?php endif; ?>


                    <?php if (!empty($error)): ?>
                        <p class="error_message"><?= $error; ?></p>
                    <?php endif; ?>


            <!-- login form -->
            <form action="#" method="POST">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" value="<?= htmlspecialchars($email ?? '') ?>" required>

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
