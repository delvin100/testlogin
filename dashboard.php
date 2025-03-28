<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php"); // Redirect if not logged in
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* Internal CSS for Dashboard Page */

        /* Modern CSS Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(-45deg, #ff6f91, #ff8e53, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated Background */
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Floating Particles */
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            animation: float 10s infinite ease-in-out;
        }

        .particle:nth-child(odd) {
            width: 8px;
            height: 8px;
            animation-duration: 15s;
        }

        .particle:nth-child(even) {
            width: 12px;
            height: 12px;
            animation-duration: 20s;
        }

        @keyframes float {
            0% { transform: translateY(100vh) scale(0.5); opacity: 0; }
            50% { opacity: 0.5; }
            100% { transform: translateY(-100vh) scale(1); opacity: 0; }
        }

        /* Fade-in Animation */
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(50px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* Navigation Bar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            z-index: 1000;
        }

        .navbar-brand h1 {
            font-size: 1.5rem;
            color: #333;
            font-weight: 600;
        }

        .navbar-links {
            display: flex;
            gap: 1.5rem;
        }

        .navbar-links a {
            color: #666;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .navbar-links a:hover {
            color: #23a6d5;
        }

        .navbar-links a.active {
            color: #23a6d5;
            font-weight: 600;
        }

        .navbar-links .logout-btn {
            background: linear-gradient(45deg, #e73c7e, #ff6f91);
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .navbar-links .logout-btn:hover {
            background: linear-gradient(45deg, #ff6f91, #e73c7e);
            color: white;
        }

        /* Dashboard Container */
        .dashboard-container {
            margin-top: 80px; /* Space for fixed navbar */
            padding: 2rem;
            max-width: 1200px;
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 2rem;
            margin-left: auto;
            margin-right: auto;
        }

        /* Welcome Section */
        .welcome-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-out;
        }

        .section-title {
            font-size: 2rem;
            color: #333;
            margin-bottom: 0.5rem;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: -8px;
            transform: translateX(-50%);
            width: 40px;
            height: 2px;
            background: linear-gradient(to right, #23a6d5, #23d5ab);
            border-radius: 1px;
        }

        .section-subtitle {
            font-size: 14px;
            color: #666;
            margin-top: 1rem;
        }

        /* Profile Card */
        .profile-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            animation: fadeIn 1s ease-out;
        }

        .card-header {
            border-bottom: 1px solid #e1e1e1;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }

        .card-header h3 {
            font-size: 1.5rem;
            color: #333;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .profile-info p {
            font-size: 14px;
            color: #666;
            margin: 0.5rem 0;
        }

        .profile-info p strong {
            color: #333;
            font-weight: 500;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-align: center;
        }

        .btn-primary {
            background: linear-gradient(45deg, #23a6d5, #23d5ab);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #23d5ab, #23a6d5);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(35, 166, 213, 0.3);
        }

        /* Quick Links */
        .quick-links {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            animation: fadeIn 1s ease-out;
        }

        .links-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .link-card {
            background: white;
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .link-card h4 {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .link-card p {
            font-size: 13px;
            color: #666;
        }

        .link-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            background: linear-gradient(45deg, #f9f9f9, #fff);
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            position: relative;
            bottom: 0;
            width: 100%;
            margin-top: 2rem;
        }

        .footer p {
            font-size: 13px;
            color: #666;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 1rem;
            }

            .navbar-links {
                flex-direction: column;
                gap: 0.5rem;
                text-align: center;
            }

            .dashboard-container {
                padding: 1rem;
            }

            .welcome-section {
                padding: 1.5rem;
            }

            .section-title {
                font-size: 1.6rem;
            }

            .profile-card, .quick-links {
                padding: 1rem;
            }
        }

        @media (max-width: 480px) {
            .navbar-brand h1 {
                font-size: 1.2rem;
            }

            .navbar-links a {
                font-size: 13px;
            }

            .welcome-section {
                padding: 1rem;
            }

            .section-title {
                font-size: 1.4rem;
            }

            .link-card h4 {
                font-size: 1rem;
            }

            .link-card p {
                font-size: 12px;
            }
        }
    </style>
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

    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-brand">
            <h1>MyApp</h1>
        </div>
        <div class="navbar-links">
            <a href="dashboard.php" class="active">Dashboard</a>
            <a href="profile.php">Profile</a>
            <a href="settings.php">Settings</a>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="dashboard-container">
        <!-- Welcome Section -->
        <section class="welcome-section">
            <h2 class="section-title">Welcome, <?php echo htmlspecialchars($_SESSION["user"]); ?>!</h2>
            <p class="section-subtitle">You are logged in. Here's a quick overview of your dashboard.</p>
        </section>

        <!-- Profile Card -->
        <section class="profile-card">
            <div class="card-header">
                <h3>Your Profile</h3>
            </div>
            <div class="card-body">
                <div class="profile-info">
                    <p><strong>Username:</strong> <?php echo htmlspecialchars($_SESSION["user"]); ?></p>
                    <p><strong>Email:</strong> user@example.com</p> <!-- Replace with actual email from DB -->
                    <p><strong>Joined:</strong> March 28, 2025</p> <!-- Replace with actual join date -->
                </div>
                <a href="profile.php" class="btn btn-primary">Edit Profile</a>
            </div>
        </section>

        <!-- Quick Links / Recent Activity -->
        <section class="quick-links">
            <h3 class="section-title">Quick Links</h3>
            <div class="links-grid">
                <a href="settings.php" class="link-card">
                    <h4>Settings</h4>
                    <p>Manage your account settings.</p>
                </a>
                <a href="activity.php" class="link-card">
                    <h4>Recent Activity</h4>
                    <p>View your recent actions.</p>
                </a>
                <a href="support.php" class="link-card">
                    <h4>Support</h4>
                    <p>Get help or contact support.</p>
                </a>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>© 2025 MyApp. All rights reserved.</p>
    </footer>
</body>
</html>