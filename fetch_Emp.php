<?php
header("Content-Type: application/json");

// Database connection
include 'config.php';

// Fetch employee data
$query = "SELECT id, first_name, email FROM users role = 'employee'";
$result = $connection->query($query);

$employees = [];
while ($row = $result->fetch_assoc()) {
    $employees[] = $row;
}

// Return JSON data
echo json_encode($employees);
$connection->close();
?>

