<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Style/adminPanel.css">
    <script src="script.js" defer></script>
</head>
<body>
<?php

                session_start();

                include 'config.php';
                $user_id = $_SESSION['id']; // Get user ID from session
                    
                // Fetch employee data
                $query = "SELECT first_name FROM users WHERE id = '$user_id'";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result); // Fetch data as an associative array
                $first_name = $row['first_name'];

                $user = htmlspecialchars($first_name); // Prevent XSS attacks
                
                
            ?>
<?php
    include 'adminPanel.php';
?>

    <!-- Main Content -->
    <div class="main-content">
        <?php
            include 'adminNav.php';
        ?>

         <!-- Dashboard Content -->
        <div class="dashboard">


            <div class="grid">
                <div class="card quote" style="display:flex;justify-content:center;align-items:center;font-size: 137%;font-weight:bold;">
                    Welcome, <b><?php echo $user; ?></b>
                </div>

                <div class="card payday" >
                    <h3>Pay Day</h3>
                    <p>Pay Day: 1st of every month.</p>
                    <p>Days Remaining: <b id="days-remaining"></b></p>
                    <div class="progress-bar" style="background: #eee; height: 10px; border-radius: 10px;">
                        <div id="progress" style="height: 100%; background: #4caf50; border-radius: 10px;"></div>
                    </div>
                </div>
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
        

    include 'config.php';
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

                <div class="card data">
                    <h3>Data of <span id="month-name"></span></h3>
                    <p>Work Days: <b id="work-days"><?php echo $work_day ?></b></p>
                    <p>Weekends (Sundays): <b id="weekends"><?php echo $sundays ?></b></p>
                    <p>Holidays: <b id="holidays"><?php echo $holidays ?></b></p>
                </div>

            
            </div>

            <div class="quick-actions">
                <div class="action-card"><img src="payroll.png" alt="#" class="img_d"> <h2>Pay Roll</h2><a href="adminPay.php" style="color : white; text-decoration :none;">GO TO PAYMENTS →</a></div>
                <div class="action-card"><img src="attandance.png" alt="#" class="img_d"><h2>Attendance</h2><a href="adminAtnd.php" style="color : white; text-decoration :none;">GO TO ATTENDANCE →</a></div>
                <div class="action-card"><img src="calender.png" alt="#" class="img_d"><h2>Calender</h2><a href="adminCal.php" style="color : white; text-decoration :none;">GO TO CALENDER →</a></div>
                <div class="action-card"><img src="support.png" alt="#" class="img_d"><h2>Support</h2><a href="adminReq.php" style="color : white; text-decoration :none;">GO TO REQUEST →</a></div>
            </div>
        </div>
    </div>
</body>
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
