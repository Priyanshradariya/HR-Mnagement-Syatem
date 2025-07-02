<?php
// Database connection
$servername = "localhost";
$username = "root"; // Change this if you have a different MySQL username
$password = ""; // Change this if you have a MySQL password
$database = "hrms";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>