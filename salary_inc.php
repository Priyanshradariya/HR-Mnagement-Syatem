<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Employee</title>
    <link rel="stylesheet" href="Style/add_emp.css">
</head>
<?php

    

    include 'config.php';
    
    $id = $_GET['value']; // Get the value from the URL
    

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $increment = trim($_POST["incr"]);
    

    
        $query = "UPDATE employee SET basic_salary = '$increment' WHERE emp_id = '$id'";
        $stmt = $conn->prepare($query);

        if ($stmt->execute()) {
        
            header("Location: adminEmp.php"); // Redirect to the dashboard
            exit();
            

        }
    }
   



?>
<?php
    $query2 = "SELECT basic_salary FROM employee WHERE emp_id = '$id'";
    $result2 = mysqli_query($conn, $query2);
    if ($result2 && mysqli_num_rows($result2) > 0) {
        $row2 = $result2->fetch_assoc();
        $basic_salary = $row2['basic_salary'];
    }
?>
<body>

    <div class="container" style="margin-top : 40px;">

        <div class="form-container">
            <h2>Leave Approval</h2>

            
            <form method="POST">
                <div class="form-group">
                    <h3>Old Salary</h3>
                    <input type="text" id="first" name="first" value="<?php echo $basic_salary; ?>" disabled >
                </div>

                <div class="form-group">
                    <h3>New Salary</h3>
                    <input type="text" id="incr" name="incr" required value="<?php echo $basic_salary; ?>" >
                </div>


                <div>
               <button class="btn" style="margin-top : 20px;">UPDATE</button>
               
                </div>
            </form>
        </div>
    </div>

</body>
</html>


