<?php
var_dump($_POST);
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];

    $conn = new mysqli('localhost', 'root', '', 'mysql');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        echo "Connection successful<br>";
    }

    $sql = "INSERT INTO details (name, email, phone, department) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $phone, $department);

    if ($stmt->execute()) {
        echo "Data inserted successfully";
    } else {
        die("Error: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method or no POST data received.";
}
?>