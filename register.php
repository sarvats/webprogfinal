<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Car Enthusiast Hub</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="header">
        <div class="logo">
            <h1>Car Enthusiast Hub</h1>
        </div>
        <nav class="nav">
        <ul>
            <li><a href="index.php" class="active">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="forum.php">Forum</a></li>
                <li><a href="garage.php">Garage</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="events.php" class="active">Events</a></li>
                <?php if (isset($_SESSION['username'])): ?>
                    <!-- Show Logout if logged in -->
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <!-- Show Login and Register if not logged in -->
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        
    </header>

    <main class="main-content">
        <section class="register-section">
            <h2>Register</h2>
            <p>Create an account to join the community!</p>

            <form action="register_process.php" method="POST" class="register-form" id="registerForm">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter a username" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter a password" required>

                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm your password" required>

                <button type="submit" class="cta-button">Register</button>
            </form>

            <p class="login-link">
                Already have an account? <a href="login.php
">Login here</a>.
            </p>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; 2024 Car Enthusiast Hub. All rights reserved.</p>
        <p><a href="contact.php
">Contact Us</a></p>
    </footer>

    <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;

            if (password !== confirmPassword) {
                alert('Passwords do not match. Please try again.');
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
