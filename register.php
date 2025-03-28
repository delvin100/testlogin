<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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

    <!-- Registration Form -->
    <form id="registerForm" action="register.php" method="POST">
        <h2 class="form-title">Register</h2>

        <div class="input-group">
            <input type="text" id="username" name="username" required>
            <label for="username">Username</label>
        </div>

        <div class="input-group">
            <input type="email" id="email" name="email" required>
            <label for="email">Email</label>
        </div>

        <div class="input-group">
            <input type="password" id="password" name="password" required>
            <label for="password">Password</label>
            <span class="toggle-password">👁️</span>
        </div>

        <button type="submit">Register</button>

        <!-- PHP Feedback Messages -->
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Securely hash password

            // Check if the email or username already exists
            $check_sql = "SELECT * FROM users WHERE email = ? OR username = ?";
            $check_stmt = $conn->prepare($check_sql);
            $check_stmt->bind_param("ss", $email, $username);
            $check_stmt->execute();
            $result = $check_stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<div class='error-message'>Error: User already exists!</div>";
            } else {
                $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $username, $email, $password);

                if ($stmt->execute()) {
                    echo "<div class='success-message'>Registration successful! Redirecting...</div>";
                    header("Refresh: 2; url=login.php"); // Redirect after 2 seconds
                    exit();
                } else {
                    echo "<div class='error-message'>Error: Something went wrong!</div>";
                }
            }

            $check_stmt->close();
        }
        ?>

        <div class="form-footer">
            <span>Already have an account?</span>
            <a href="login.php">Login here</a>
        </div>
    </form>
</body>
</html>