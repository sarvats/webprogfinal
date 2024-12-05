<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'car_enthusiast');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT forum_posts.id, forum_posts.title, forum_posts.created_at, users.username 
                        FROM forum_posts 
                        JOIN users ON forum_posts.user_id = users.id 
                        ORDER BY forum_posts.created_at DESC 
                        LIMIT 5");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Car Enthusiast Hub</title>
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
        <section class="welcome-section">
            <h2>Welcome to Car Enthusiast Hub</h2>
            <?php if (isset($_SESSION['username'])): ?>
                <p>Hello, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>! Glad to see you back!</p>
            <?php else: ?>
                <p>Join the ultimate community for car lovers!</p>
                <a href="register.php" class="cta-button">Join Now</a>
            <?php endif; ?>
        </section>

        <section class="forum-preview">
            <h3>Recent Forum Posts</h3>
            <div class="forum-cards">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="forum-card">
                            <h4><a href="thread.php?id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['title']); ?></a></h4>
                            <p><strong>Posted by:</strong> <?php echo htmlspecialchars($row['username']); ?></p>
                            <p><small><?php echo htmlspecialchars($row['created_at']); ?></small></p>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No recent posts available. <a href="forum.php">View Forum</a></p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; 2024 Car Enthusiast Hub. All rights reserved.</p>
        <p><a href="contact.php">Contact Us</a></p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
