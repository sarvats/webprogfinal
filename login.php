<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Car Enthusiast Hub</title>
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
        <section class="login-section">
            <h2>Login</h2>
            <p>Welcome back! Please enter your credentials to log in.</p>
            
            <form id="loginForm" action="login_process.php" method="POST" onsubmit="return validateLoginForm();">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>

                <button type="submit" class="cta-button">Login</button>
            </form>
            
            <p class="register-link">
                Don't have an account? <a href="register.php">Register here</a>.
            </p>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; 2024 Car Enthusiast Hub. All rights reserved.</p>
        <p><a href="contact.php">Contact Us</a></p>
    </footer>

    <script>
        // JavaScript Validation
        function validateLoginForm() {
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();

            if (username === "") {
                alert("Username is required.");
                return false;
            }

            if (password === "") {
                alert("Password is required.");
                return false;
            }

            if (password.length < 6) {
                alert("Password must be at least 6 characters long.");
                return false;
            }

            return true; 
        }
    </script>
</body>
</html>
