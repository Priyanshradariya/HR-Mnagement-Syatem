<!DOCTYPE html>
<html>

<head>
    <title>HTML Login Form</title>
    <link rel="stylesheet" href="Style/login.css">
</head>

<body>
    <div class="main">
        <h1>Login Page</h1>

        <form action="login.php" method="POST">
            <label for="first">
                Email
            </label>
            <input type="text" id="email" name="email" 
                placeholder="Enter your Mail" required>

            <label for="password">
                Password:
            </label>
            <input type="password" id="password" name="password" 
                placeholder="Enter your Password" required>

              
                <div class="text-center" >
                                    <a style="color:white ; text-decoration: none;" class="font-weight-bold small" href="forgatepassword.php">
                                        Forget Password?
                                    </a>
                  </div>
            <div class="wrap">
                <button type="submit">
                    Submit
                </button>
            </div>
        </form>
        
        <p>Not registered?
            <a href="register.php" style="text-decoration: none;">
                Create an account
            </a>
        </p>
    </div>
</body>

</html>

<?php
    session_start();
    include 'config.php'; // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prevent SQL Injection
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to check the user
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);
 
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
    
       
        // Verify password
        if ($password ==  $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['first_name'] = $user['first_name'];

            
             
            
            if($user['role'] == "admin") {
                //header("Location: adminDash.php?value='$name'"); // Redirect to the dashboard
                $_SESSION['id'] = $user['id'];
                
                header("Location: adminDash.php?value={$user['first_name']}");
                exit();
            }
            else{
                $_SESSION['id'] = $user['id'];
                header("Location: Employee/empDash.php?value={$user['first_name']}"); // Redirect to the dashboard
                exit();
            }
            
        } else {
            echo "<script>alert('Invalid Email or Password'); window.location='login.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid Email or Password'); window.location='login.php';</script>";
    }
    }
?>

<script>
    document.querySelector("form").addEventListener("submit", function (e) {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const passwordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    
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


