<?php
session_start();

if (!isset($_GET['id'])) {
    die("Invalid thread ID.");
}

$conn = new mysqli('localhost', 'root', '', 'car_enthusiast');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$post_id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT forum_posts.title, forum_posts.content, forum_posts.created_at, users.username 
                        FROM forum_posts 
                        JOIN users ON forum_posts.user_id = users.id 
                        WHERE forum_posts.id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$post_result = $stmt->get_result();

if ($post_result->num_rows == 1) {
    $post = $post_result->fetch_assoc();
} else {
    die("Thread not found.");
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?> - Car Enthusiast Hub</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="header">
        <div class="logo">
            <h1>Car Enthusiast Hub</h1>
        </div>
        <nav class="nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="forum.php" class="active">Forum</a></li>
                <li><a href="garage.php">Garage</a></li>
                <li><a href="about.php">About Us</a></li>
                <?php if (isset($_SESSION['username'])): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php
">Login</a></li>
                    <li><a href="register.php
">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main class="main-content">
        <section class="thread-details">
            <h2><?php echo htmlspecialchars($post['title']); ?></h2>
            <p><strong>Posted by:</strong> <?php echo htmlspecialchars($post['username']); ?> on <?php echo htmlspecialchars($post['created_at']); ?></p>
            <p class="thread-content"><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
        </section>

        <section class="comments-section">
            <h3>Comments</h3>
            <div class="comments">
                <?php
                // Fetch comments
                $comment_result = $conn->query("SELECT comments.content, comments.created_at, users.username 
                                                FROM comments 
                                                JOIN users ON comments.user_id = users.id 
                                                WHERE comments.post_id = $post_id 
                                                ORDER BY comments.created_at ASC");

                if ($comment_result->num_rows > 0) {
                    while ($comment = $comment_result->fetch_assoc()) {
                        echo "
                        <div class='comment'>
                            <p><strong>" . htmlspecialchars($comment['username']) . ":</strong> " . nl2br(htmlspecialchars($comment['content'])) . "</p>
                            <p class='comment-date'><small>Posted on " . htmlspecialchars($comment['created_at']) . "</small></p>
                        </div>";
                    }
                } else {
                    echo "<p>No comments yet. Be the first to comment!</p>";
                }
                ?>
            </div>

            <?php if (isset($_SESSION['user_id'])): ?>
            <form action="add_comment.php" method="POST" class="comment-form">
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                <textarea name="comment_content" placeholder="Write your comment..." rows="4" required></textarea>
                <button type="submit" class="cta-button">Add Comment</button>
            </form>
            <?php else: ?>
            <p><a href="login.php
">Login</a> to add a comment.</p>
            <?php endif; ?>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; 2024 Car Enthusiast Hub. All rights reserved.</p>
    </footer>
</body>
</html>
