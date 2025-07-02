<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../E_Style/empProfile.css">
    <title>Document</title>
</head>
<body>
<?php
            session_start();
            include '../config.php';
            $user_id = $_SESSION['id']; // Get user ID from session

        

        // Handle attendance marking
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $emp_name = trim($_POST["fname"]);
            $emp_phone = trim($_POST["mobileNo"]);
            $emp_dob = trim($_POST["dob"]);
            $emp_adrs = trim($_POST["adrs"]);
            $approval = trim($_POST["status_val"]);
            

            $query = "UPDATE employee SET  emp_name = ? , emp_phone = ?, birthdate = ?, address = ?, emp_gender = ? WHERE emp_id = ?";

            if ($stmt = $conn->prepare($query)) {
                // Bind parameters (s = string, i = integer, etc.)
                $stmt->bind_param("sssssi", $emp_name, $emp_phone, $emp_dob, $emp_adrs, $approval , $user_id);
                $stmt->execute();
                header("Location:empProfile.php?name=My Profile");
                exit();
            }
        }

?>
    <?php
    include '../config.php';

     require("empPanel.php");
    ?>

    <div class="main-content">
        <?php
            include 'empNav.php';
        ?>  
<?php

include '../config.php';
$user_id = $_SESSION['id']; // Get user ID from session
    
// Fetch employee data
$query = "SELECT * FROM employee WHERE emp_id = '$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result); // Fetch data as an associative array
$id = $user['emp_id'];
$email = $user['emp_email'];
$name = $user['emp_name'];
$phone = $user['emp_phone'];
$gender = $user['emp_gender'];
$birthdate = $user['birthdate'];
$adress = $user['address'];
$hiredate = $user['hiredate'];

$emp_name = htmlspecialchars($name); 
$emp_id = htmlspecialchars($id); 
$emp_email = htmlspecialchars($email); 
$emp_hiredate = htmlspecialchars($hiredate); 

if($phone == NULL)
{
    $emp_phone = "-";
}
else
{
    $emp_phone = htmlspecialchars($phone);
}

if($adress == NULL)
{
    $emp_adress = "-";
}
else
{
    $emp_adress = htmlspecialchars($adress);
}

if($gender == NULL)
{
    $emp_gender = "-";
}
else
{
    $emp_gender = htmlspecialchars($gender);
}

if($birthdate == NULL)
{
    $emp_birthdate= "-";
}
else
{
    $emp_birthdate = htmlspecialchars($birthdate);
}


?>
<div class="employee-view">
            <h2>Employee View</h2>
            <button class="modify-btn" id="edit-btn">✏️ Modify Data</button>
            
            <div class="info-section">
                <h3>Basic Info</h3>
                <div class="info-grid">
                    <label>Name</label>
                    <span id="name" ><?php echo $emp_name ?></span>
                    
                    <label>ID</label>
                    <span id="id" ><?php echo $emp_id ?></span>
                    
                    <label>Phone</label>
                    <span id="phone"><?php echo $emp_phone ?></span>
                    
                    

                    <label>Email</label>
                    <span id="email" ><?php echo $emp_email ?></span>

                    <label>Gender</label>
                    <span id="gender" ><?php echo $emp_gender ?></span>

                    

                    <label>Birthday</label>
                    <span id="birthday" ><?php echo $emp_birthdate ?></span>

                    <label>Hire Date</label>
                    <span id="hire-date"><?php echo $emp_hiredate ?></span>

                    

                    <label>Address</label>
                    <span id="address"><?php echo $emp_adress ?></span>
                </div>
            </div>
        </div>

        <!-- Form (Hidden by default) -->
        <div class="edit-form-container" id="edit-form-container">
            <h2>Edit Employee Data</h2>
            <form id="edit-form" method="POST">
                <label>Name:</label>
                <input type="text" name="fname"  id="edit-name" required>

                <label>ID:</label>
                <input type="text" name="empId" id="edit-id" disabled  value = "<?php echo $emp_id ?>">

                <label>Phone:</label>
                <input type="text"  name="mobileNo" id="edit-phone" required>

                <label>Email:</label>
                <input type="email" name="email" id="edit-email" disabled>

                <label style="margin-bottom : 8px">Gender:</label>
                <div style="margin-left : -5px">
                    <label>
                        <input type="radio" id="radio" name="status_val" id="edit-gender" value="Male" checked >  Male
                    </label>

                    <label>
                        <input type="radio" id="radio" name="status_val" id="edit-gender" value="Female" > Female
                    </label>
                </div>
                
                <label>Birthday:</label>
                <input type="date" name="dob" id="edit-birthday" required>

                <label>Address:</label>
                <input type="text" name="adrs" id="edit-address" required>

                <button type="submit">Save Changes</button>
                <button type="button" id="cancel-btn">Cancel</button>
            </form>
        </div>
    </div>

</body>
</html>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const editBtn = document.getElementById("edit-btn");
    const editFormContainer = document.getElementById("edit-form-container");
    const cancelBtn = document.getElementById("cancel-btn");
    const editForm = document.getElementById("edit-form");

    // Data fields
    const dataFields = ["name", "id", "phone", "email", "gender", "birthday", "hire-date", "address"];

    // Open Edit Form
    editBtn.addEventListener("click", function () {
        editFormContainer.style.display = "block";
        
            dataFields.forEach(field => {
            let value = document.getElementById(field).textContent;
            let inputField = document.getElementById(`edit-${field}`);
            if (inputField) {
                inputField.value = value === "-" ? "" : value;
            }
        });
        
    });

    // Close Edit Form
    cancelBtn.addEventListener("click", function () {
        editFormContainer.style.display = "none";
    });

    
});

</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const editForm = document.getElementById("edit-form");
        const phoneInput = document.getElementById("edit-phone");

        // Validate mobile number
        function validatePhoneNumber(phone) {
            const phonePattern = /^[6-9]\d{9}$/;
            return phonePattern.test(phone);
        }

        // Form submission event
        editForm.addEventListener("submit", function (event) {
            const phone = phoneInput.value.trim();

            if (!validatePhoneNumber(phone)) {
                alert("Please enter a valid 10-digit Indian mobile number starting with 6, 7, 8, or 9.");
                event.preventDefault(); // Prevent form submission
                return false;
            }
        });
    });
</script>


