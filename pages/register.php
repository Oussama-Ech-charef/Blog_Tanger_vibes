

<?php 


session_start();


require '../config/connection.php';


$error = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];



    if (empty($name) || empty($email) || empty($password)) {

        $error = "All fields are required.";


        // valide email 


    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Invalid email format.";

        // valide password 

    } elseif (strlen($password) < 6) {


        $error = "Password must be at least 6 characters.";

    } else {


        // valid email existing 
        $stmt = $conn->prepare("select id_user from users where email = ?");

        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {

                $error = "Email already exists.";
                
            } else {
                // password hash 
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // add user 
                    $stmt = $conn->prepare("
                            insert into users (user_name, email, password, role)
                            values (?, ?, ?, 'user')
                    ");

                    $stmt->execute([$name, $email, $hashed_password]);


                    $_SESSION['success'] = "Account created successfully.";


                    header("Location: login.php");
                    exit();
            }

    }


    
    

    
}




?>





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

                    <?php if(!empty($error)): ?>
                        <p class="error_message"><?= $error; ?></p>
                    <?php endif; ?>


            <form action="#" method="POST">
                <label for="name">Full name</label>
                <input type="text" id="name" name="name" placeholder="Your name" value="<?= htmlspecialchars($name ?? '') ?>" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" value="<?= htmlspecialchars($email ?? '') ?>" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Create password" required>

                <button type="submit" class="btn">Create account</button>
            </form>

            <p class="switch">Already have an account? <a href="login.php">Login</a></p>

        </section>
    </main>

</body>
</html>
