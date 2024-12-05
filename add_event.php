<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'car_enthusiast');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_name = mysqli_real_escape_string($conn, $_POST['event_name']);
    $event_description = mysqli_real_escape_string($conn, $_POST['event_description']);
    $event_date = mysqli_real_escape_string($conn, $_POST['event_date']);
    $event_location = mysqli_real_escape_string($conn, $_POST['event_location']);

    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO events (event_name, event_description, event_date, event_location, user_id) 
              VALUES ('$event_name', '$event_description', '$event_date', '$event_location', '$user_id')";

    if ($conn->query($query) === TRUE) {
        header("Location: events.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

$conn->close();
?>
