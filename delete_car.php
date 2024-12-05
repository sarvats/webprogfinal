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

    $stmt = $conn->prepare("DELETE FROM cars WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $car_id, $user_id);

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        header("Location: garage.php?success=Car deleted successfully");
    } else {
        echo "Error: Unable to delete car or unauthorized access.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
