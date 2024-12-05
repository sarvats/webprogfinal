<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'car_enthusiast');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $car_id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM cars WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $car_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $car = $result->fetch_assoc();
    } else {
        echo "Car not found or unauthorized access.";
        exit();
    }

    $stmt->close();
} else {
    echo "Invalid request.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="header">
        <div class="logo">
            <h1>Car Enthusiast Hub</h1>
        </div>
    </header>

    <main class="main-content">
        <section class="edit-car-section">
            <h2>Edit Car</h2>
            <form action="update_car.php" method="POST" class="edit-car-form">
                <input type="hidden" name="car_id" value="<?php echo htmlspecialchars($car['id']); ?>">

                <label for="make">Make:</label>
                <input type="text" id="make" name="make" value="<?php echo htmlspecialchars($car['make']); ?>" required>

                <label for="model">Model:</label>
                <input type="text" id="model" name="model" value="<?php echo htmlspecialchars($car['model']); ?>" required>

                <label for="year">Year:</label>
                <input type="number" id="year" name="year" value="<?php echo htmlspecialchars($car['year']); ?>" min="1900" max="2099" required>

                <label for="description">Description:</label>
                <textarea id="description" name="description"><?php echo htmlspecialchars($car['description']); ?></textarea>

                <label for="image_url">Image URL:</label>
                <input type="url" id="image_url" name="image_url" value="<?php echo htmlspecialchars($car['image_url']); ?>">

                <button type="submit" class="cta-button">Update Car</button>
            </form>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; 2024 Car Enthusiast Hub. All rights reserved.</p>
    </footer>
</body>
</html>
