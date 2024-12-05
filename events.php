<?php
$conn = new mysqli('localhost', 'root', '', 'car_enthusiast');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM events ORDER BY event_date ASC";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Enthusiast - Events</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <header class="header">
        <div class="logo">
            <h1>Car Enthusiast</h1>
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

    <div class="main-content">
        <section class="welcome-section">
            <h2>Upcoming Events</h2>
            <p>Join us at these exciting car enthusiast events!</p>
        </section>

        <div class="form-container">
            <h2>Add an Event</h2>
            <form action="add_event.php" method="POST">
                <input type="text" name="event_name" placeholder="Event Name" required>
                <textarea name="event_description" placeholder="Event Description" required></textarea>
                <input type="date" name="event_date" required>
                <input type="text" name="event_location" placeholder="Event Location" required>
                <button type="submit" class="cta-button">Submit Event</button>
            </form>
        </div>

        <div class="events-list">
            <?php if ($result->num_rows > 0): ?>
                <table class="events-table">
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['event_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['event_description']); ?></td>
                                <td><?php echo htmlspecialchars($row['event_date']); ?></td>
                                <td><?php echo htmlspecialchars($row['event_location']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No upcoming events. Be the first to add one!</p>
            <?php endif; ?>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2024 Car Enthusiast. All rights reserved.</p>
    </footer>
</body>
</html>
