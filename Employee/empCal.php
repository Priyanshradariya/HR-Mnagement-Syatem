<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../Style/adminPanel.css">
    <link rel="stylesheet" href="../Style/adminCal.css">
    <script src="script.js" defer></script>
</head>
<script>
        document.addEventListener("DOMContentLoaded", function () {
    const initiateBtn = document.querySelector(".initiate-btn");
    const leaveForm = document.getElementById("leave-form");
    
    
    // Show form on button click
    initiateBtn.addEventListener("click", function () {
        leaveForm.style.display = "block";
        initiateBtn.style.display = "none"; // Hide button when form appears
    });

});

</script>
<style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background-color: #f2f2f2;
        }
        td {
            width: 100px;
            height: 60px;
            text-align: center;
            /* vertical-align: top; */
            border: 1px solid #ccc;
            
        }
        .holiday-date{
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            justify-content: space-evenly;
            background: #222;
            padding: 10px;
            border-radius: 10px;
        }
        lable{
            width:100px;
        }

        .initiate-btn{
            background: purple;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
            float : right;
        }

        .add-holiday{
            background: purple;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            width: 100%;
        }

        .selectDate
        {
            
            padding: 10px;
            border: 1px solid #333;
            border-radius: 5px;
            background: #2f2b2b;
            color: white;
        }

        .holidayReason
        {
            width: 60%;
            padding: 10px;
            border: 1px solid #333;
            border-radius: 5px;
            background: #2f2b2b;
            color: white; 
        }

        .pagination{
            width: 98%;
            background-color: #b6b0b0;
            margin: 2px;
            margin-top: 18px;
            padding: 9px;
            color: black;
            display: flex;
            justify-content: space-between;
        }

        .pagination span{
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 27px;
            font-weight: bold;
        }
        .pagination a{
            margin: 10px;
            font-size: 20px;
            text-decoration: none;
            font-weight: bold;
            color: black;
        }

        .navCal{
            background: #222;
            padding: 16px;
            border-radius: 7px;
            display: flex;
            justify-content: space-evenly;
            flex-direction: row;

        }
        .holiday{    padding: 5px;}
    </style>
<body>
<?php
  session_start();
 include '../config.php';

 

?>
<?php
    
    include 'empPanel.php';
?>
<?php
include '../config.php';

// Fetch holidays from the database
$holidays = [];
$result = $conn->query("SELECT date, title FROM events");
while ($row = $result->fetch_assoc()) {
    $holidays[$row['date']] = $row['title'];
}


$conn->close();
define('DAYS_OF_WEEK', ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']);

function generateMonthlyCalendar($year, $month, $holidays) {
    $firstDay = mktime(0, 0, 0, $month, 1, $year);
    $totalDays = date('t', $firstDay);
    $dayOfWeek = date('D', $firstDay);
    
    include '../config.php';
    $employeeId = $_SESSION['id']; // Change this to the specific employee ID you want to check
    // hiredate
    $hire_res = $conn->query("SELECT created_at FROM users WHERE id='$employeeId'");
    $hire_row = $hire_res->fetch_assoc();
    $hireDate = $hire_row['created_at'];

    // echo "<h2>" . date('F Y', $firstDay) . "</h2>";
    echo "<table><tr>";
    foreach (DAYS_OF_WEEK as $day) {
        echo "<th style='color :black; padding: 5px 5px;background-color: #b6b0b0;border: 1px solid #ccc;'>$day</th>";
    }
    echo "</tr><tr>";

    for ($i = 0; $i < array_search($dayOfWeek, DAYS_OF_WEEK); $i++) {
        echo "<td></td>";
    }

    for ($day = 1; $day <= $totalDays; $day++) {
        $date = sprintf('%04d-%02d-%02d', $year, $month, $day);
        
        
        // Fetch attendance data
        $attendanceQuery = $conn->prepare("SELECT status FROM attendance WHERE attender_id = ? AND attendance_date = ?");
        $attendanceQuery->bind_param("is", $employeeId, $date);
        $attendanceQuery->execute();
        $attendanceResult = $attendanceQuery->get_result();

        $TodayDate = date("Y-m-d");

        
        $attendanceStatus = '❌'; // Default to absent (cross)
        if ($attendanceRow = $attendanceResult->fetch_assoc()) {
            if ($attendanceRow['status'] == 'On-time' || $attendanceRow['status'] == 'Late') {
                $attendanceStatus = '✅'; // Present (check mark)
            }
        }
        else if($TodayDate < $date || $hireDate > $date)
        {
            $attendanceStatus = '';
        }
       
        $result = $conn->query("SELECT type FROM events WHERE date='$date'");
        
        if($row = $result->fetch_assoc())
        {
            $holidayType = $row['type'];
        }
        
        
        // $attendText = isset($Atd[$date]) ? "<br><div style='display: flex;justify-content: space-around'><span style='width : 100px;display: block;word-wrap: break-word;white-space: normal;'>✅</span></div>" : "<span style='width : 100px;display: block;word-wrap: break-word;white-space: normal;'>❌</span>";
        $holidayText = isset($holidays[$date]) ? "<br><div style='display: flex;justify-content: space-around'><span style='color:" . ($holidayType === 'HOLIDAY' ? 'red' : ($holidayType === 'MEETING' ? 'blue' : ($holidayType === 'EVENT' ? 'green' : 'yellow'))) . ";width : 100px;display: block;word-wrap: break-word;white-space: normal;'>{$holidays[$date]}</span></div>" : "";
        if (date('l', strtotime($date)) == 'Sunday') {
            echo "<td style='color : red;font-weight : bold;'>$day $holidayText</td>";
        }
        else{
            echo "<td><div style='display : flex;'>$attendanceStatus</div> $day $holidayText</td>";
        }
        
        if (($day + array_search($dayOfWeek, DAYS_OF_WEEK)) % 7 == 0) {
            echo "</tr><tr>";
        }
    }
    echo "</tr></table>";
}

// Handle month navigation
if (isset($_GET['year']) && isset($_GET['month'])) {
    $year = intval($_GET['year']);
    $month = intval($_GET['month']);
} else {
    $year = date('Y');
    $month = date('n');
}
?>

    <!-- Main Content -->
    <div class="main-content">
      <?php
           include 'empNav.php';
           
        ?>  

<div class="calendar" style="width : 97%;">
<form method="get" class="navCal">
    <label for="month" >Select Month:</label>
    <select name="month" id="month" style="width: 22%;margin-left: -71px;background: gray;color: white; padding: 8px;margin-top: -7px;">
        <?php
        for ($m = 1; $m <= 12; $m++) {
            $selected = ($m == ($_GET['month'] ?? date('n'))) ? 'selected' : '';
            echo "<option value='$m' $selected>" . date('F', mktime(0, 0, 0, $m, 10)) . "</option>";
        }
        ?>
    </select>

    <label for="year">Select Year:</label>
    <select name="year" id="year" style="width: 22%;margin-left: -71px;background: gray;color: white;padding: 8px;margin-top: -7px;">
        <?php
        $currentYear = date('Y');
        for ($y = $currentYear - 20; $y <= $currentYear ; $y++) {
            $selected = ($y == ($_GET['year'] ?? $currentYear)) ? 'selected' : '';
            echo "<option value='$y' $selected>$y</option>";
        }
        ?>
    </select>

    <button type="submit" style="    width: 144px;margin-top: -7px;color:white;margin-bottom: -3px;background:purple">Filter</button>
</form>

    <div class="chart" style="margin-top:12px;    margin-right: 6px;display: flex;flex-direction: row-reverse;">
        <div class="holiday" style="background:red;">Holiday</div>
        <div class="holiday" style="background:blue;">Meeting</div>
        <div class="holiday" style="background:green;">Event</div>
        <div class="holiday" style="background:yellow;color:black">Other</div>
    </div>
        
        <div class="pagination">
            <a href="?year=<?= $year ?>&month=<?= $month - 1 ?>"><&lt; Previous</a>
            <span><?= date('F Y', mktime(0, 0, 0, $month, 1, $year)) ?></span>
            <a href="?year=<?= $year ?>&month=<?= $month + 1 ?>">Next >&gt;</a>
        </div>

        <?php generateMonthlyCalendar($year, $month, $holidays); ?>
    </div>
    
        </div>
    </div>
</body>
</html>




  


