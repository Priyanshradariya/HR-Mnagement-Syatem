<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Style/adminPanel.css">
    <link rel="stylesheet" href="Style/adminCal.css">
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
            height: 75px;
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
            margin-top: -48px;
            float : right;
            font-weight: bold;
            margin-right: 21px;
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
        .navCalander{
            width: 97%;
            height: 56px;
            display : flex;
            flex-direction: row;
            justify-content: space-between;
        }
        .dateFilter{
            width : 79%;
            color: white;
            display : flex;
            flex-direction: row;
            justify-content: flex-start;
            border: 1px solid #333;
            border-radius: 5px;
            background: #222;

        }
        .holiday{    padding: 5px;}
    </style>
<body>
<?php
 include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['holidayDate']) && isset($_POST['holidayTitle'])) {
    $date = $_POST['holidayDate'];
    $title = $_POST['holidayTitle'];
    $type = $_POST['holidayType'];
    $result = $conn->query("SELECT date FROM events WHERE date='holidayDate'");
    $totalRow = $result->num_rows;
    if($totalRow == 0)
    {
        $stmt = $conn->prepare("INSERT INTO events (date, title,type) VALUES (?, ?,?)");
        $stmt->bind_param("sss", $date, $title,$type);
        $stmt->execute();
        $stmt->close();
    }
    header("Location:adminCal.php?name=Calendar");
    exit(); 

}
?>
<?php
    
    include 'adminPanel.php';
?>
<?php
include 'config.php';

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
        include 'config.php';
       
        $result = $conn->query("SELECT type FROM events WHERE date='$date'");
        
        if($row = $result->fetch_assoc())
        {
            $holidayType = $row['type'];
        }

        $holidayText = isset($holidays[$date]) ? "<br><div style='display: flex;justify-content: space-around'><span style='color:" . ($holidayType === 'HOLIDAY' ? 'red' : ($holidayType === 'MEETING' ? 'blue' : ($holidayType === 'EVENT' ? 'green' : 'yellow'))) . ";width : 100px;display: block;word-wrap: break-word;white-space: normal;'>{$holidays[$date]}</span></div>" : "";
        if (date('l', strtotime($date)) == 'Sunday') {
            echo "<td style='color : red;font-weight : bold;'>$day $holidayText</td>";
        }
        else{
            echo "<td style='font-weight : bold;'>$day $holidayText</td>";
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
           include 'adminNav.php';
           
        ?>  

<div class="calendar" style="width : 97%;">
<form method="get">
    <div class="navCalander">
        <div class="dateFilter">
            <label for="month" style="padding-left: 10px;display: flex;justify-content: center;align-items: center;">Select Month:</label>
            <select name="month" id="month" style="margin-left: 10px;width: 180px;padding-left: 57px;height: 39px;margin-top: 7px;background: grey;border-radius: 7px;font-weight: bold;">
                <?php
                for ($m = 1; $m <= 12; $m++) {
                    $selected = ($m == ($_GET['month'] ?? date('n'))) ? 'selected' : '';
                    echo "<option value='$m' $selected>" . date('F', mktime(0, 0, 0, $m, 10)) . "</option>";
                }
                ?>
            </select>


            <label for="year" style="padding-left: 39px;display: flex;justify-content: center;align-items: center;">Select Year:</label>
            <select name="year" id="year" style="margin-left: 10px;padding-left: 57px;width: 180px;height: 39px;margin-top: 7px;background: grey;border-radius: 7px;font-weight: bold;">
                <?php
                $currentYear = date('Y');
                for ($y = $currentYear - 20; $y <= $currentYear + 100; $y++) {
                    $selected = ($y == ($_GET['year'] ?? $currentYear)) ? 'selected' : '';
                    echo "<option value='$y' $selected>$y</option>";
                }
                ?>
            </select>

            <button type="submit" style="color: white;margin-left: 90px;width: 156px;height: 39px;margin-top: 7px;background: purple;border: 1px solid black;border-radius: 8px">Filter</button>

        </div>
          
    </div>
</form>  
        <div>
            <button class="initiate-btn">✏️ +Create a Calander Item</button>
        </div>  
        <div class="chart" style="margin-top:12px;    margin-right: 6px;display: flex;flex-direction: row-reverse;">
        <div class="holiday" style="background:red;">Holiday</div>
        <div class="holiday" style="background:blue;">Meeting</div>
        <div class="holiday" style="background:green;">Event</div>
        <div class="holiday" style="background:yellow;color:black">Other</div>
    </div>
        <form action="adminCal.php?name=Calendar" id="leave-form" method="POST" style="display : none;">
        <h2>Create a Calander Item</h2>    
        <div class="holiday-date">
                <div style="width : 100%">
                    <label for="holidayDate" >Select Date:</label>
                    <input type="date" name="holidayDate" class="holidayReason" required>
                </div>
                
                <div style="width : 100%">
                    <label for="holidayType" >Type:</label>
                    <select name="holidayType" placeholder="Enter holiday title" class="holidayReason" required>
                        <option value="">Choose Type</option>
                        <option value="MEETING">Meeting</option>
                        <option value="HOLIDAY">Holiday</option>
                        <option value="EVENT">Event</option>
                        <option value="OTHER">Other</option>
                    </select>
                </div>
                
                <div style="width : 100%">
                    <label for="holidayTitle" >Title:</label>
                    <input type="text" name="holidayTitle" placeholder="Enter holiday title" class="holidayReason" required>
                </div>
            
            </div>
            <button type="submit" class="add-holiday">Add Holiday</button>
        </form>

        <div class="pagination">
            <a href="?year=<?= $year ?>&month=<?= $month - 1 ?>"><&lt; Previous</a>
            <span><?= date('F Y', mktime(0, 0, 0, $month, 1, $year)) ?></span>
            <a href="?year=<?= $year ?>&month=<?= $month + 1 ?>">Next >&gt;</a>
        </div>

        <?php generateMonthlyCalendar($year, $month, $holidays); ?>
    </div>

        <!-- <div style="display: flex; justify-content: center;">
            <div class="calendar">
                <div class="calendar-header">
                    <button class="nav-button" onclick="prevMonth()">❮</button>
                    <span id="month-year"></span>
                    <button class="nav-button" onclick="nextMonth()">❯</button>
                </div>
                <div class="calendar-days" id="calendar-days"></div>
            </div>
        </div> -->
        
            
        </div>
    </div>
</body>
</html>

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

