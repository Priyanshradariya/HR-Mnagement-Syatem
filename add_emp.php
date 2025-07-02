<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Employee</title>
    <link rel="stylesheet" href="Style/add_emp.css">
</head>
 <style>
      
      .popup {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
  }

  .popup-content {
    background-color: white;
    margin: 15% auto;
    padding: 20px;
    border-radius: 5px;
    width: 345px;
  }
 </style>
<body>

    <div class="container">

        <div class="form-container">
            <h2>Add a New Employee</h2>

            <form action="add_emp.php" method="POST">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" id="first" name="first" placeholder="Enter Username">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email"  id="email" name="email" placeholder="Enter Email">
                </div>

                <div class="form-group full-width">
                    <label>Password</label>
                    <input type="password" id="password" placeholder="Enter password" name="password">
                </div>

                <div>
               <button class="btn">ADD EMPLOYEE</button>
               
                </div>
            </form>
        </div>
    </div>

</body>
</html>

<?php

include 'config.php'; // Database connection file

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST["first"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $role = "employee";

    // Password hashing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $email = mysqli_real_escape_string($conn, $email);

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);
 
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
    }

    if($email == $user['email'])
    {
        echo "<script>alert('email is already taken');window.location='add_emp.php';</script>";
    }
    else{
    
    // Insert into database
    $sql = "INSERT INTO users (first_name, email, password, role) VALUES ('$first_name','$email','$password','$role')";
    $stmt = $conn->prepare($sql);
    //$stmt->bind_param("ssss", $first_name, $email, $hashed_password, $role);

    if ($stmt->execute()) {
        
        header("Location: AdminEmp.php"); // Redirect to the dashboard
        exit();

    } else {
        echo "Error: " . $stmt->error;
    }
    }

    $stmt->close();
}

$conn->close();
?>

<script>
    document.querySelector("form").addEventListener("submit", function (e) {
    const firstName = document.getElementById("first").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    

    const nameRegex = /^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/;
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const passwordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    

    if (!nameRegex.test(firstName)) {
        alert("Invalid First Name! Only letters are allowed.");
        e.preventDefault();
    }
    
    if (!emailRegex.test(email)) {
        alert("Invalid Email! Please enter a correct email address.");
        e.preventDefault();
    }

    if (!passwordRegex.test(password)) {
        alert("Invalid Password! It must contain at least 8 characters, an uppercase letter, a number, and a special character.");
        e.preventDefault();
    }

    
});

</script>

<script>
        

        function confirmShow() {
            // Add your actual logout logic here
            
            window.location.href = "AdminEmp.php";

            
        }
    </script>

