<?php 
error_reporting(0);
session_start();    
include_once 'config.php';
$email = $_SESSION["email"];
if(isset($_POST["submit"]))
{
    $OTP = $_POST['OTP'];

    if(empty($OTP)){
        echo "Something went wrong";
    }
    else{
    $sql = "SELECT OTP from users where email = '$email'";

   $ans =  mysqli_query($conn,$sql);  
   $row = mysqli_fetch_assoc($ans);

    if($row['OTP'] == $OTP)
   { 
       ?>
       <script>
        window.location.href = "ChangeForgotpassword.php"
        </script>
       <?php 

    }
    else{
        echo '<script>alert("Incorrect OTP");</script>';
        ?>
       <script>
        window.location.href = "OTPForgotpassword.php"
        </script>
       <?php 
    }
    }
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>HRMS</title>
        
        <!-- CSS FILES -->
       
    <body>
        <main><!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Education Loan Management System - Sign In</title>
        <style>
        /* Reset and basic styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            width: 100vw;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0d1117; /* Dark background */
            font-family: 'Inter', sans-serif;
        }

        main {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .sign-in-form {
            background: #161b22; /* Card background */
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.6);
            width: 100%;
            max-width: 500px;
            text-align: center;
            animation: fadeIn 1s ease;
        }

        .hero-title {
            color: #ffffff;
            font-size: 2rem;
            margin-bottom: 30px;
            font-weight: 700;
        }

        .form-floating {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-floating input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #30363d;
            border-radius: 8px;
            background-color: #21262d;
            color: #c9d1d9;
            font-size: 16px;
        }

        .form-floating input:focus {
            border-color: #58a6ff;
            outline: none;
            background-color: #21262d;
            color: #ffffff;
        }

        .form-floating label {
            margin-top: 8px;
            font-size: 14px;
            color: #8b949e;
        }

        .custom-btn {
            background-color: #238636;
            color: #ffffff;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .custom-btn:hover {
            background-color: #2ea043;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive for smaller screens */
        @media (max-width: 600px) {
            .sign-in-form {
                padding: 30px 20px;
            }
        }
    </style>
    </head>
    
    <body>
        <main>
            <section class="sign-in-form section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto col-12">
                            <h1 class="hero-title text-center mb-5">One Time Password(OTP)</h1>

                            <div class="row">
                                <div class="col-lg-8 col-11 mx-auto">
                                    <form  method="post">
                                        <div class="form-floating mb-4">
                                            <input type="number" name="OTP" id="email" class="form-control" placeholder="Enter OTP *" required>
                                           
                                        </div>
                                        <button type="submit" class="btn custom-btn form-control mt-4 mb-3" name="submit">
                                            Submit
                                        </button>
                                      
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- JAVASCRIPT FILES -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        
    </body>
</html>