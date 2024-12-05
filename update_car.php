<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php
");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'car_enthusiast');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $car_id = intval($_POST['car_id']);
    $user_id = $_SESSION['user_id'];
    $make = trim($_POST['make']);
    $model = trim($_POST['model']);
    $year = intval($_POST['year']);
    $description = trim($_POST['description']);
    $image_url = trim($_POST['image_url']);

    
    if (empty($make) || empty($model) || empty($year)) {
        die("Make, Model, and Year are required. <a href='edit_car.php?id=$car_id'>Go back</a>");
    }

   
    $stmt = $conn->prepare("UPDATE cars SET make = ?, model = ?, year = ?, description = ?, image_url = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ssissii", $make, $model, $year, $description, $image_url, $car_id, $user_id);

    if ($stmt->execute()) {
        header("Location: garage.php?success=Car updated successfully");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
