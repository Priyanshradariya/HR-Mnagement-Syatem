<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Style/adminPanel.css">
    <script src="Script.js"></script>
</head>

<body>
    <!-- Sidebar -->

    <div class="sidebar">
        <h2>Admin Tools</h2>
        <hr>
        <div class="menu-tog">
            <button id="menu-toggle" class="menu-btn">☰</button>
        </div>
        <ul id="menu">
            <a href="adminDash.php?name=Dashboard" class="tools" style="color : white;text-decoration : none;">
                <li class="menu-item">My Dashboard</li>
            </a>
            <a href="adminEmp.php?name=Employees" class="tools" style="color : white;text-decoration : none;">
                <li class="menu-item">Employees</li>
            </a>
            <a href="adminReq.php?name=Requests"  class="tools" style="color : white;text-decoration : none;">
                <li class="menu-item">Requests</li>
            </a>
            <a href="adminCal.php?name=Calendar" class="tools" style="color : white;text-decoration : none;">
                <li class="menu-item">Calendar</li>
            </a>
            <a href="adminAtnd.php?name=Attendance" class="tools" style="color : white;text-decoration : none;">
                <li class="menu-item">Attendance</li>
            </a>
            <a href="adminPay.php?name=Payrolls" class="tools" style="color : white;text-decoration : none;">
                <li class="menu-item">Payrolls</li>
            </a>
            <a href="changePswd.php" class="tools" style="color : white;text-decoration : none;">
                <li class="menu-item">Change Password</li>
            </a>
        </ul>
    </div>


</body>

</html>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const menu = document.getElementById("menu");
        const menuBtn = document.getElementById("menu-toggle");

        menuBtn.addEventListener("click", function () {
            menu.classList.toggle("active");
        });
    });



</script>