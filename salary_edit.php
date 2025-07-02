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
    $bonus = (float)trim($_POST["bonus"]);
    $deduction = (float)trim($_POST["deduction"]);
    $status_edit = trim($_POST["status_val"]);
    
        $query = "SELECT total_salary FROM payroll WHERE employee_id = '$id'";
        $result = mysqli_query($conn, $query);

        if ($row = mysqli_fetch_assoc($result)) {
        
            $total_salary = $row['total_salary'];
        }

        
        
        $query2 = "UPDATE payroll SET bonus = $bonus, deduction = $deduction, status = '$status_edit' WHERE pay_id = '$id'";    
        $stmt2 = $conn->prepare($query2);

        if ($stmt2 -> execute()) {
            $total_salary = $total_salary + $bonus;
            $total_salary = $total_salary - $deduction;

            $month = date('m', strtotime('last month')); // get previous month
            $year = date('Y', strtotime('last month'));

            $query3 = "UPDATE payroll SET total_salary = $total_salary WHERE pay_id = '$id' ";    
            $stmt3 = $conn->prepare($query3);
            $stmt3 -> execute();

            header("Location: adminPay.php?value=$total_salary"); // Redirect to the dashboard
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
            <h2>Bonus-Deduction</h2>

            
            <form method="POST">
                <div class="form-group">
                    <h3>Bonus</h3>
                    <input type="text" id="bn" name="bonus"  >
                </div>

                <div class="form-group">
                    <h3>Deduction</h3>
                    <input type="text" id="dd" name="deduction"   >
                </div>

                <h3>Select Status:</h3>
                    <label>
                        <input type="radio" id="radio" name="status_val" value="Paid" > Paid
                    </label>

                    <label>
                        <input type="radio" id="radio" name="status_val" value="Pending" checked> Pending
                    </label>

                <div>
               <button class="btn" style="margin-top : 20px;">Edit Salary</button>
               
                </div>
            </form>
        </div>
    </div>

</body>
</html>




