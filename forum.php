<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum - Car Enthusiast Hub</title>
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
        <section class="forum-section">
            <h2>Forum</h2>
            <p>Join the discussion! Share your thoughts, ask questions, or help others in the community.</p>
            
            <!-- New Post Form -->
            <div class="new-post-form">
                <h3>Create a New Post</h3>
                <form action="create_post.php" method="POST">
                    <label for="post-title">Title:</label>
                    <input type="text" id="post-title" name="post_title" placeholder="Enter your post title" required>
                    
                    <label for="post-content">Content:</label>
                    <textarea id="post-content" name="post_content" placeholder="Write your post here..." rows="5" required></textarea>
                    
                    <button type="submit" class="cta-button">Post</button>
                </form>
            </div>
            
            <div class="forum-topics">
    <h3>Recent Topics</h3>
    <ul>
        <?php

        $conn = new mysqli('localhost', 'root', '', 'car_enthusiast');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $result = $conn->query("SELECT forum_posts.id, forum_posts.title, forum_posts.created_at, users.username 
                                FROM forum_posts 
                                JOIN users ON forum_posts.user_id = users.id 
                                ORDER BY forum_posts.created_at DESC");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "
                <li>
                    <a href='thread.php?id=" . $row['id'] . "'>" . htmlspecialchars($row['title']) . "</a>
                    <p>Posted by " . htmlspecialchars($row['username']) . " on " . htmlspecialchars($row['created_at']) . "</p>
                </li>";
            }
        } else {
            echo "<p>No topics available. Be the first to post!</p>";
        }

        $conn->close();
        ?>
    </ul>
</div>

        </section>
    </main>

    <footer class="footer">
        <p>&copy; 2024 Car Enthusiast Hub. All rights reserved.</p>
        <p><a href="contact.php">Contact Us</a></p>
    </footer>
</body>
</html>
