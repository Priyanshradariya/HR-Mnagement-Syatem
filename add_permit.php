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
    $reason = trim($_POST["first"]);
    $approval = trim($_POST["status_val"]);

    if($approval == "Approved")
    {
        $query = "UPDATE leave_req SET status = 'Approved' WHERE leave_id = '$id'";
        $stmt = $conn->prepare($query);

        if ($stmt->execute()) {
        
            header("Location: AdminReq.php"); // Redirect to the dashboard
            exit();
            

        }
    }
   
}

$conn->close();
?>

<body>

    <div class="container" style="margin-top : 40px;">

        <div class="form-container">
            <h2>Leave Approval</h2>

            
            <form method="POST">
                <div class="form-group">
                    <h3>Reason (if Rejected)</h3>
                    <input type="text" id="first" name="first" placeholder="Enter Reason">
                </div>

                <h3>Select Status:</h3>
                    <label>
                        <input type="radio" id="radio" name="status_val" value="Approved" > ✅ Approved
                    </label>

                    <label>
                        <input type="radio" id="radio" name="status_val" value="Rejected" > ❌ Rejected
                    </label>


                <div>
               <button class="btn" style="margin-top : 20px;">SUBMIT</button>
               
                </div>
            </form>
        </div>
    </div>

</body>
</html>

<script>
    document.querySelector("form").addEventListener("submit", function (e) {
    
        let radios = document.getElementsByName("status_val");
            let isChecked = false;

            for (let i = 0; i < radios.length; i++) {
                if (radios[i].checked) {
                    isChecked = true;
                    break;
                }
            }


    if (!isChecked) {
        alert("Select One Option");
        e.preventDefault();
    }
    
    

    
});

</script>

