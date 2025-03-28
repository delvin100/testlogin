<?php include 'db_connect.php'; session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <script defer src="script.js"></script>
</head>
<body>
    <!-- Background Particles -->
    <div class="particles">
        <div class="particle" style="left: 10%; top: 20%;"></div>
        <div class="particle" style="left: 30%; top: 50%;"></div>
        <div class="particle" style="left: 50%; top: 70%;"></div>
        <div class="particle" style="left: 70%; top: 30%;"></div>
        <div class="particle" style="left: 90%; top: 60%;"></div>
    </div>

    <!-- Login Form -->
    <form id="loginForm" action="login.php" method="POST">
        <h2 class="form-title">Login</h2>

        <div class="input-group">
            <input type="text" id="username" name="username" required>
            <label for="username">Username</label>
        </div>

        <div class="input-group">
            <input type="password" id="password" name="password" required>
            <label for="password">Password</label>
            <span class="toggle-password">👁️</span>
        </div>

        <button type="submit">Login</button>

        <!-- PHP Feedback Messages -->
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];

            $sql = "SELECT id, password FROM users WHERE username=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $hashed_password);
            $stmt->fetch();

            if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
                $_SESSION["user"] = $username; // Start session
                header("Location: dashboard.php"); // Redirect to dashboard
                exit();
            } else {
                echo "<div class='error-message'>Invalid login details</div>";
            }
            $stmt->close();
        }
        ?>

        <div class="form-footer">
            <span>Don't have an account?</span>
            <a href="register.php">Register here</a>
        </div>
    </form>
</body>
</html>