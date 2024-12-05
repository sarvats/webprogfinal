<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garage - Car Enthusiast Hub</title>
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
        <section class="garage-section">
            <h2>My Garage</h2>
            <p>Manage your car collection. Add, edit, or remove cars in your garage.</p>
            
            <div class="add-car-form">
                <h3>Add a New Car</h3>
                <form action="add_car.php" method="POST">
                    <label for="car-make">Make:</label>
                    <input type="text" id="car-make" name="car_make" placeholder="e.g., Ford" required>
                    
                    <label for="car-model">Model:</label>
                    <input type="text" id="car-model" name="car_model" placeholder="e.g., Mustang" required>
                    
                    <label for="car-year">Year:</label>
                    <input type="number" id="car-year" name="car_year" placeholder="e.g., 2022" min="1900" max="2099" required>
                    
                    <label for="car-description">Description:</label>
                    <textarea id="car-description" name="car_description" placeholder="Add a short description..." rows="3"></textarea>
                    
                    <label for="car-image">Image URL:</label>
                    <input type="url" id="car-image" name="car_image" placeholder="e.g., https://example.com/car.jpg">

                    <button type="submit" class="cta-button">Add Car</button>
                </form>
            </div>
            
            <div class="car-collection">
                <h3>Your Collection</h3>
                <div class="car-grid">
                    <?php
            
                    if (!isset($_SESSION['user_id'])) {
                        echo "<p>Please <a href='login.php>login</a> to view your collection.</p>";
                        exit();
                    }
                    $conn = new mysqli('localhost', 'root', '', 'car_enthusiast');
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
            
                    $user_id = $_SESSION['user_id'];
                    $result = $conn->query("SELECT * FROM cars WHERE user_id = $user_id");
            
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "
                            <div class='car-card'>
                                <img src='" . htmlspecialchars($row['image_url'] ?: 'https://via.placeholder.com/150') . "' alt='Car Image'>
                                <div class='car-details'>
                                    <h4>" . htmlspecialchars($row['make'] . " " . $row['model']) . "</h4>
                                    <p><strong>Year:</strong> " . htmlspecialchars($row['year']) . "</p>
                                    <p>" . htmlspecialchars($row['description']) . "</p>
                                    <div class='car-actions'>
                                        <a href='edit_car.php?id=" . $row['id'] . "' class='edit-btn'>Edit</a>
                                        <a href='delete_car.php?id=" . $row['id'] . "' class='delete-btn'>Delete</a>
                                    </div>
                                </div>
                            </div>";
                        }
                    } else {
                        echo "<p>You have no cars in your collection. Add one using the form above!</p>";
                    }
            
                    $conn->close();
                    ?>
                </div>
            </div>
            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; 2024 Car Enthusiast Hub. All rights reserved.</p>
        <p><a href="contact.php">Contact Us</a></p>
    </footer>
</body>
</html>
