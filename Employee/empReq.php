<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../E_Style/empReq.css">
    <title>Document</title>
</head>

<?php


session_start(); // Start session
include '../config.php'; // Database connection file

if (!isset($_SESSION['id'])) {
    die("Error: User not logged in.");
}
$user_id = $_SESSION['id']; // Get user ID from session

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_request']) ) {
    // Get form data
    $type = $_POST['type'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $message = $_POST['message'];

    // Prepare SQL query
    $sql = "INSERT INTO leave_req (created_by, type, start_date, end_date, status, message, created_at) 
            VALUES ('$user_id', '$type', '$start_date', '$end_date', 'pending', '$message', CURRENT_TIMESTAMP)";
    
    $stmt = $conn->prepare($sql);
    // Execute query
    if ($stmt->execute()) {
        header("Location: " . $_SERVER['PHP_SELF']);
    }
    else{
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}




$conn->close();
?>

<body>
    <?php
     require("empPanel.php");
    ?>

<div class="main-content">
    <?php
           include 'empNav.php';
    ?>  

    <div class="container">
    <div class="container">
        <!-- Request Table -->
        <div class="requests-card">
            <h2>Current Requests</h2>
            <button class="initiate-btn">+ Initiate A Request</button>
            
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>CREATED BY</th>
                        <th>TYPE</th>
                        <th>START DATE</th>
                        <th >END DATE</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody id="request-table">
                <?php

                    // Database connection
                    include '../config.php';

                    $user_id = $_SESSION['id']; // Get user ID from session
                    
                    // Fetch employee data
                    $query = "SELECT first_name FROM users WHERE id = '$user_id'";
                    $result = mysqli_query($conn, $query);
                    
                    $row = mysqli_fetch_assoc($result); // Fetch data as an associative array
                    $first_name = $row['first_name'];
                    $conn->close();
                    
                    // Database connection
                    include '../config.php';
                    
                    $query = "SELECT * FROM leave_req WHERE created_by = '$user_id'";
                    $result = mysqli_query($conn, $query);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$row['leave_id']}</td>
                                        <td>" . htmlspecialchars($first_name) . "</td>
                                        <td>" . htmlspecialchars($row['type']) . "</td>
                                        <td>" . htmlspecialchars($row['start_date']) . "</td>
                                        <td>" . htmlspecialchars($row['end_date']) . "</td>
                                        <td>" . htmlspecialchars($row['status']) . "</td>
                                    </tr>";
                            }
                        }
                        $conn->close();
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Hidden Leave Request Form -->
        <div class="leave-form-container" id="leave-form">
            <h2>Create a Request</h2>
            <form id="leaveRequestForm" method="POST">
                <div class="form-group">
                    <label for="requestType">Type</label>
                    <select id="requestType" name="type" required>
                        <option value="">Choose a Request Type</option>
                        <option value="Leave">Leave</option>
                        <option value="Work From Home">Work From Home</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="requestDate">Start-Date</label>
                    <input type="date" name="start_date" id="requestDate" required>
                </div>

                <div class="form-group">
                    <label for="requestDate">End-Date</label>
                    <input type="date" name="end_date" id="requestDate" required>
                </div>

                <div class="form-group">
                    <label for="requestMessage">Message</label>
                    <textarea id="requestMessage" name="message" placeholder="Enter your reason..." required></textarea>
                </div>

                <button type="submit" class="submit-btn" name="submit_request">Initiate Request</button>
            </form>
        </div>

    </div>

    
</div>
</div>
</body>
</html>







<script>
        document.addEventListener("DOMContentLoaded", function () {
    const initiateBtn = document.querySelector(".initiate-btn");
    const leaveForm = document.getElementById("leave-form");

    // Show form on button click
    initiateBtn.addEventListener("click", function () {
        leaveForm.style.display = "block";
        initiateBtn.style.display = "none"; // Hide button when form appears
    });

});

</script>