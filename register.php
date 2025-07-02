<?php

include 'config.php'; // Database connection file

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST["first"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $role = $_POST["role"];
    $user_count = 0;
    // Password hashing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $email = mysqli_real_escape_string($conn, $email);

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);
 
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        if($email == $user['email'])
            {
                $user_count = 1;
                echo "<script>alert('email is already taken');
                window.location='register.php';</script>";
                
            }
        
    }

    if($user_count == 0)
    {
       // Insert into database
    $sql = "INSERT INTO users (first_name, email, password, role) VALUES ('$first_name','$email','$password','$role')";
    $stmt = $conn->prepare($sql);
    //$stmt->bind_param("ssss", $first_name, $email, $hashed_password, $role);
    
    if ($stmt->execute()) {
        
        if($role == "admin") {
            header("Location: login.php?value='$name'"); // Redirect to the dashboard
            exit();
        }
        else if($role == "employee")
        {
            $sql = "SELECT id FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($user_emp);
            $stmt->fetch();
            $stmt->close();
            $query = "INSERT INTO employee(`emp_id`, `emp_name`, `emp_phone`, `emp_email`, `emp_gender`, `birthdate`, `hiredate`, `address`,`basic_salary`) VALUES ('$user_emp','$first_name',NULL,'$email',NULL,NULL,CURDATE(),NULL,0.00)";
            $conn->query($query);
            header("Location: login.php?value='$name'"); // Redirect to the dashboard
            exit();
        } 

    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
 
    }
   
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HTML Registration Form</title>
    <link rel="stylesheet" href="Style/register.css">
</head>

<body>
    <div class="main">
        <h2>Registration Form</h2>
        <form action="" method="POST">
            <label for="first">First Name:</label>
            <input type="text" id="first" name="first" placeholder="Enter username" required />
            <span id="name-error" class="error-message"></span>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter email" required />

            <label for="password">Password:</label>
            <input type="password" id="password" placeholder="Enter password" name="password">

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="admin">
                    Admin
                </option>
                <option value="employee">
                    Employee
                </option>
            </select>

            <button type="submit">
                Submit
            </button>

            <p>already registered?
            <a href="login.php" style="text-decoration: none;">
                Log In
            </a>
        </p>
        </form>
    </div>
</body>

</html>


<script>
    document.querySelector("form").addEventListener("submit", function (e) {
    const firstName = document.getElementById("first").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const role = document.getElementById("role").value;

    const nameRegex = /^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/;
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const passwordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    const roleRegex = /^(admin|employee)$/;

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

    if (!roleRegex.test(role)) {
        alert("Invalid Role! Choose either Admin or Employee.");
        e.preventDefault();
    }
});

</script>
