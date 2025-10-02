<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "tu-sekolah"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$username = $_POST['username'];
$password = $_POST['password'];
$nama_lengkap = $_POST['nama_lengkap'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO user (username, password, nama_lengkap) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $password, $nama_lengkap);

// Execute the statement
if ($stmt->execute()) {
    echo "Registration successful!";
    header("Location: ../index.php"); // Redirect to the login page
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
