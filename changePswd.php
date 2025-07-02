<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Employee</title>
    <link rel="stylesheet" href="Style/add_emp.css">
</head>
<style>
    .show-hide-toggle {
    cursor: pointer;
    color: #007bff;
    font-size: 14px;
    margin-left: 5px;
}

.show-hide-toggle:hover {
    text-decoration: underline;
}
</style>
<?php
session_start();
include 'config.php'; // Database connection

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['id']; // Get logged-in user ID
    $oldPswd = $_POST['oldPswd'];
    $newPswd = $_POST['newPswd'];
    $conPswd = $_POST['conPswd'];

    // Fetch the current password from DB
    $query = "SELECT role,password FROM users WHERE id = '$user_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $currentPassword = $row['password'];
       

        // Check if old password matches
        if ($oldPswd !== $currentPassword) { 
            echo "<script>alert('Old password is incorrect!'); window.location.href='changePswd.php';</script>";
            exit();
        }

        // Check if new password and confirm password match
        if ($newPswd !== $conPswd) {
            echo "<script>alert('New password and confirm password do not match!'); window.location.href='changePswd.php';</script>";
            exit();
        }

        // Update password
        $updateQuery = "UPDATE users SET password='$newPswd' WHERE id='$user_id'";
        if (mysqli_query($conn, $updateQuery)) {
            
            if($row['role'] == "admin")
            {
                echo "<script>alert('Password updated successfully!'); window.location.href='adminDash.php';</script>";
            exit();
            }
            else{
                echo "<script>alert('Password updated successfully!'); window.location.href='Employee/empDash.php';</script>";
            exit();
            }
            
        } else {
            echo "<script>alert('Something went wrong!'); window.location.href='changePswd.php';</script>";
            exit();
        }
    }
    mysqli_close($conn);
}
?>



<body>

<div class="container" style="margin-top: 40px;">
    <div class="form-container">
        <h2>Change Password</h2>

        <form method="POST" onsubmit="return validatePassword();">
            <div class="form-group">
                <h3>Old Password</h3>
                <input type="password" required id="oldPswd" name="oldPswd">
            </div>

            <div class="form-group">
                <h3>New Password</h3>
                <input type="password" id="newPswd" required name="newPswd">
                <span id="showNewPassword" class="show-hide-toggle" onclick="togglePasswordVisibility('newPswd')">Show</span>
            </div>

            <div class="form-group">
                <h3>Confirm Password</h3>
                <input type="password" id="confirmPswd" required name="conPswd">
                <span id="showConfirmPassword" class="show-hide-toggle" onclick="togglePasswordVisibility('confirmPswd')">Show</span>
            </div>

            <div>
                <button class="btn" style="margin-top: 20px;">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
// Show/Hide password functionality
function togglePasswordVisibility(passwordId) {
    var passwordField = document.getElementById(passwordId);
    var showHideButton = document.getElementById('show' + passwordId.charAt(0).toUpperCase() + passwordId.slice(1));

    if (passwordField.type === "password") {
        passwordField.type = "text";
        showHideButton.textContent = "Hide";
    } else {
        passwordField.type = "password";
        showHideButton.textContent = "Show";
    }
}

// Password validation
function validatePassword() {
    var oldPassword = document.getElementById('oldPswd').value;
    var newPassword = document.getElementById('newPswd').value;
    var confirmPassword = document.getElementById('confirmPswd').value;

    // Check if new password and confirm password match
    if (newPassword !== confirmPassword) {
        alert("New password and confirm password do not match.");
        return false; // Prevent form submission
    }

    // Check password length and other conditions
    if (newPassword.length < 8) {
        alert("Password must be at least 8 characters long.");
        return false;
    }

    // If all validations are passed, allow form submission
    return true;
}
</script>


</body>
</html>





