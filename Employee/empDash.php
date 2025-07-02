<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../E_Style/empDash.css">
    <title>Document</title>
</head>

<body>
<?php

            session_start();

            include '../config.php';
            $user_id = $_SESSION['id']; // Get user ID from session
                
            // Fetch employee data
            $query = "SELECT first_name FROM users WHERE id = '$user_id'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result); // Fetch data as an associative array
            $first_name = $row['first_name'];

            $user = htmlspecialchars($first_name); // Prevent XSS attacks


?>
<?php

            include '../config.php';
            $user_id = $_SESSION['id']; // Get user ID from session

        

        // Handle attendance marking
        if (isset($_POST['mark_attendance'])) {
            date_default_timezone_set("Asia/Kolkata");
            $date = date("Y-m-d");
            $time = date("H:i:s");
            

            // Check if attendance for today is already marked
            $checkQuery = "SELECT * FROM attendance WHERE attender_id = '$user_id' AND attendance_date = '$date'";
            $result = $conn->query($checkQuery);

            if ($result->num_rows == 0) 
            {
                if($time > "10:00:00")
                {
                    $status = "Late";
                }
                else{
                    $status = "On-time";
                }

                $sql = "INSERT INTO attendance (attender_id,attendance_date,attendance_time, status) VALUES ('$user_id','$date', '$time', '$status')";
                $conn->query($sql);
                
            }
        }

        // Check if attendance is already marked for today
        $date = date("Y-m-d");
        $Sunday = date('l', strtotime($date)) == 'Sunday';
        $checkQuery = "SELECT * FROM attendance WHERE attender_id = '$user_id' AND attendance_date = '$date'";
        $result = $conn->query($checkQuery);
        $buttonDisabled = ($result->num_rows > 0);
        
        
        if($Sunday)
        {
            $buttonText = "Weekend ! Enjoy your Day";
            $buttonDisabled = true;
        }
        else{
            $buttonText = $buttonDisabled ? "Attendance Marked" : "CLICK FOR ATTENDANCE";
        }
?>


    <?php
    require("empPanel.php");
    ?>

    <div class="main-content">
        <?php
        include 'empNav.php';
        ?>
        <div class="dashboard">
        <div class="welcome-card">
            

            <div class="welcome">
                <p style="margin : 55px;">Welcome, <span id="employee-name"><?php echo $user ?></span></p>
            </div>
           
        </div>

        <div class="attendance-card">
            <form method="POST">
            <button class="attendance-btn"  name="mark_attendance"  <?php echo $buttonDisabled ? 'disabled' : ''; ?>><?php echo $buttonText; ?></button>
            </form>
        </div>

        <div class="quote-card">
            <h2>Quote of the day</h2>
            <p class="quote">"<span id="quote-text">Loading Quote...</span>"</p>
            <p class="author">- <span id="quote-author">Loading Author...</span></p>
        </div>

    </div>
<?php  
    include '../config.php';
    $user_id = $_SESSION['id']; // Get user ID from session

    $checkQuery = "SELECT basic_salary FROM employee WHERE emp_id = '$user_id'";
    $result = $conn->query($checkQuery);
    $row = mysqli_fetch_assoc($result);
    $salary = $row['basic_salary'];

?>

    <div class="dashboard2">
    <div class="salary-card">
            <h2>Your Salary</h2>
            <p id="salary-amount"><?php echo $salary ?></p>
            
        </div>

        <div class="pay-day-card" >
        
                    <h3>Pay Day</h3>
                    <p>Pay Day: 1st of every month.</p>
                    <p>Days Remaining: <b id="days-remaining"></b></p>
                    <div class="progress-bar" style="background: #eee; height: 10px; border-radius: 10px;">
                        <div id="progress" style="height: 100%; background: #4caf50; border-radius: 10px;"></div>
                    </div>
        
        </div>

        <div class="data-card">
        <?php 



$year = date('Y');
$month = date('m');
$totalDays = date('t');

$sundays = 0;

for ($day = 1; $day <= $totalDays; $day++) {
    $date = "$year-$month-$day";
    if (date('w', strtotime($date)) == 0) { // 0 = Sunday
        $sundays++;
    }
}
    

include '../config.php';
$query  ="SELECT COUNT(*) AS total_holidays FROM events WHERE type = 'HOLIDAY' AND MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE())";
$result = $conn->query($query);

// Fetch result
if ($result && $row = $result->fetch_assoc()) {
    $holidays =  $row['total_holidays'];
} else {
    $holidays = 0;
}

$work_day = $totalDays-$sundays-$holidays;

$conn->close();

?>

            
                <h3>Data of <span id="month-name"></span></h3>
                <p>Work Days: <b id="work-days"><?php echo $work_day ?></b></p>
                <p>Weekends (Sundays): <b id="weekends"><?php echo $sundays ?></b></p>
                <p>Holidays: <b id="holidays"><?php echo $holidays ?></b></p>
             
       
    </div>
    </div>
</body>

<script>

    document.addEventListener("DOMContentLoaded", function () {
    const initiateBtn = document.querySelector(".attendance-btn");
    const attendanceCard = document.querySelector(".attendance-card");

    //attendanceCard.style.background = "green"; // Hide button when form appears

    var btColor = "<?php echo $buttonText; ?>";

    if(btColor == "Attendance Marked")
    {
        attendanceCard.style.background = "linear-gradient(to right,#000000,#0f9b0f)";
    }
    else if(btColor == "Weekend ! Enjoy your Day")
    {
        attendanceCard.style.background = "linear-gradient(to right,#f12711,#f5af19)";
    }

});
</script>
<script>
    const now = new Date();
    const today = now.getDate();
    const totalDaysInMonth = new Date(now.getFullYear(), now.getMonth() + 1, 0).getDate();

    const daysRemaining = totalDaysInMonth - today;
    const progressPercent = (today / totalDaysInMonth) * 100;

    document.getElementById("days-remaining").textContent = `${daysRemaining} Day${daysRemaining !== 1 ? 's' : ''}`;
    document.getElementById("progress").style.width = `${progressPercent}%`;
</script>
</html>