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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $make = trim($_POST['car_make']);
    $model = trim($_POST['car_model']);
    $year = trim($_POST['car_year']);
    $description = trim($_POST['car_description']);
    $image_url = trim($_POST['car_image']);

    if (empty($make) || empty($model) || empty($year)) {
        die("Make, Model, and Year are required. <a href='garage.php'>Go back</a>");
    }

    $stmt = $conn->prepare("INSERT INTO cars (user_id, make, model, year, description, image_url) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ississ", $user_id, $make, $model, $year, $description, $image_url);

    if ($stmt->execute()) {
        header("Location: garage.php?success=1"); 
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
