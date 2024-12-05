<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Car Enthusiast Hub</title>
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
        <section class="about-section">
            <h2>About Us</h2>
            <p>
                Welcome to <strong>Car Enthusiast Hub</strong>! We're a vibrant community of car lovers, where people from all walks of life come together to share their passion for automobiles.
            </p>
            <p>
                Our mission is to create a platform where car enthusiasts can connect, share ideas, and showcase their rides. Whether you're into classic cars, muscle cars, sports cars, or custom builds, this is the place for you.
            </p>
            <h3>What We Offer</h3>
            <ul class="offer-list">
                <li><strong>Forum Discussions:</strong> Engage with other enthusiasts in our active forums, covering topics from maintenance tips to modification ideas.</li>
                <li><strong>Virtual Garage:</strong> Create and manage your own virtual car collection and share it with the community.</li>
                <li><strong>Events:</strong> Stay updated on car meets, virtual gatherings, and other exciting events.</li>
            </ul>
            <h3>Our Values</h3>
            <p>
                At Car Enthusiast Hub, we believe in fostering a welcoming and inclusive community. Whether you're a seasoned gearhead or just starting your car journey, there's a place for you here.
            </p>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; 2024 Car Enthusiast Hub. All rights reserved.</p>
        <p><a href="contact.php
">Contact Us</a></p>
    </footer>
</body>
</html>
