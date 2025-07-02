<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Style/adminPanel.css">
    <link rel="stylesheet" href="Style/addAtnd.css">
    <script src="script.js" defer></script>
</head>
<body>
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
            
        <div style="display:flex; justify-content:center;">
        <div class="container">
        <h2>Attendance List</h2>

        <div class="header">
            <!-- <button id="addAttendance">+ Take/Edit Attendance</button> -->
            <div class="date-filter">
                <label for="datePicker">Filter by Date:</label>
                <input type="date" id="datePicker">
            </div>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Total Attendance</th>
                    <th>Attended On Time</th>
                    <th>Attended Late</th>
                    <th>Absent</th>
                </tr>
            </thead>
            <tbody id="attendanceTable">
            <?php

                // Database connection
                include 'config.php';
                 

                // total employee
                $query = "SELECT id FROM users";
                $result = mysqli_query($conn, $query);
                $totalUser = $result->num_rows;



                // Fetch employee data
                $query = "SELECT attendance_date , status ,  COUNT(*) AS total_rows , SUM(CASE WHEN status = 'Late' THEN 1 ELSE 0 END) AS total_late , SUM(CASE WHEN status = 'On-time' THEN 1 ELSE 0 END) AS total_on_time FROM attendance GROUP BY attendance_date";
                $result = mysqli_query($conn, $query);
                  
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $totalPresent = $row['total_rows'] ;
                            $totalAbsent = $totalUser - $totalPresent;
                            echo "<tr class='attendance-row' data-date=".$row['attendance_date'] .">
                                    <td>{$row['attendance_date']}</td>
                                    <td>" . htmlspecialchars($totalUser) . "</td>
                                    <td>" . htmlspecialchars($row['total_on_time']) . "</td>
                                    <td>" . htmlspecialchars($row['total_late']) . "</td>
                                    <td>" . htmlspecialchars($totalAbsent) . "</td>
                                    
                                </tr>";
                        }
                    }
                    $conn->close();
            ?>
            </tbody>
        </table>

        <div class="pagination">
            <button id="prevPage">❮</button>
            <span id="pageNumber" style="    margin-top: 11px; padding: 0px 10px;">1</span>
            <button id="nextPage">❯</button>
        </div>
    </div>
    </div>
            
        </div>
    </div>
</body>
</html>



<script>
    document.addEventListener("DOMContentLoaded", function () {
        let rowsPerPage = 7; // Number of rows per page
        let table = document.getElementById("attendanceTable");
        let rows = table.getElementsByTagName("tr");
        let totalPages = Math.ceil(rows.length / rowsPerPage);
        let currentPage = 1;

        function showPage(page) {
            let start = (page - 1) * rowsPerPage;
            let end = start + rowsPerPage;

            // Hide all rows first
            for (let i = 0; i < rows.length; i++) {
                rows[i].style.display = "none";
            }

            // Show only the rows for the current page
            for (let i = start; i < end && i < rows.length; i++) {
                rows[i].style.display = "table-row";
            }

            // Update page number display
            document.getElementById("pageNumber").textContent = page;

            // Enable/disable buttons based on page number
            document.getElementById("prevPage").disabled = (page === 1);
            document.getElementById("nextPage").disabled = (page === totalPages);
        }

        // Event listeners for pagination buttons
        document.getElementById("prevPage").addEventListener("click", function () {
            if (currentPage > 1) {
                currentPage--;
                showPage(currentPage);
            }
        });

        document.getElementById("nextPage").addEventListener("click", function () {
            if (currentPage < totalPages) {
                currentPage++;
                showPage(currentPage);
            }
        });

        // Show first page initially
        showPage(currentPage);
    });
</script>

<script>
    document.getElementById('datePicker').addEventListener('change', function() {
        const selectedDate = this.value;
        const rows = document.querySelectorAll('.attendance-row');

        rows.forEach(row => {
            const rowDate = row.getAttribute('data-date');
            if (rowDate === selectedDate || selectedDate === "") {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
