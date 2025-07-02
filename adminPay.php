<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Style/adminPanel.css">
    <link rel="stylesheet" href="Style/adminPay.css">
    <script src="script.js" defer></script>
</head>
<style>
    .btnApproval{
        background: none;
        border: none;
    }
    .pagination {
    display: flex;
    justify-content: center;
    margin-top: 10px;
}

.pagination button {
    margin: 0 5px;
    background-color: #444;
}

.pagination button:hover {
    background-color: #666;
}
</style>
<body>
<?php
    include 'adminPanel.php';
?>
<?php
if (date('d') == '01') {
    include 'config.php'; // connect to DB

    $month = date('m', strtotime('last month')); // get previous month
    $year = date('Y', strtotime('last month'));  // get correct year if Jan -> Dec

    $query = $conn->query("SELECT * FROM employee");

    while ($emp = $query->fetch_assoc()) {
        $id = $emp['emp_id'];
        $salary = $emp['basic_salary'];

        // Count present days for previous month
        $att = $conn->query("SELECT COUNT(*) AS present_days FROM attendance WHERE attender_id = $id AND MONTH(attendance_date) = $month  AND YEAR(attendance_date) = $year");
        $data = $att->fetch_assoc();
        $present_days = $data['present_days'];

        $bonus_deduct = $conn->query("SELECT bonus,deduction FROM payroll WHERE employee_id = $id");
        $data = $bonus_deduct->fetch_assoc();
        $bonus = $data['bonus'];
        $deduction = $data['deduction'];

        // Assume day-month
        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $daily_rate = $salary / $days_in_month;
        $total_salary = $daily_rate * $present_days;
        $total_salary += $bonus;
        $total_salary -=$deduction;

        // Insert or Update payroll
        $check = $conn->query("SELECT * FROM payroll WHERE employee_id = $id AND month = '$month' AND year = $year");
        if ($check->num_rows > 0) {
            $conn->query("UPDATE payroll SET total_salary = $total_salary WHERE employee_id = $id AND month = '$month' AND year = $year");
        } else {
            $conn->query("INSERT INTO payroll (employee_id, month, year, total_salary)  VALUES ($id, '$month', $year, $total_salary)");
        }

    }
}


?>
<?php


        // include 'config.php';
        // if (isset($_GET['value'])) {
        // $total_salary = $_GET['value']; // Get the value from the URL
        // $month = date('m', strtotime('last month')); // get previous month
        // $year = date('Y', strtotime('last month'));  // get correct year if Jan -> Dec
        // $query2 = "UPDATE payroll SET total_salary = $total_salary WHERE month = '$month' AND year = '$year' AND  ";
        // $stmt2 = $conn->prepare($query2);
        // $stmt2 -> execute();
        // }
?>


    <!-- Main Content -->
    <div class="main-content">
    <?php
           include 'adminNav.php';
    ?>  
    <div class="filters">
                <div class="serch_date_div">
                    <label for="monthFilter">Filter by Month:</label>
                    <input type="month" id="monthFilter">
                </div>
            <div>
                <label>Filter by Status:</label>
                <div class="status-filters">
                    <label><input type="radio" name="status" value="All" checked> All</label>
                    <label><input type="radio" name="status" value="Pending"> Pending</label>
                    <label><input type="radio" name="status" value="Paid"> Paid</label>
                </div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>PAYROLL ID</th>
                    <th>EMPLOYEE NAME</th>
                    <th>TOTAL AMOUNT</th>
                    <th>DUE DATE</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody id="payrollTable">
            <?php

                // Database connection
                include 'config.php';


                // Fetch employee data
                $query = "SELECT * FROM payroll";
                $result = mysqli_query($conn, $query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                            $query2 = "SELECT emp_name,emp_id FROM employee WHERE emp_id = '".$row['employee_id']."'";
                            $result2 = mysqli_query($conn, $query2);
                            $row2 = $result2->fetch_assoc();
                            $payMonth = $row['year'] . '-' . str_pad($row['month'], 2, '0', STR_PAD_LEFT);
                            echo "<tr class='status-".trim($row['status'])."' data-month='$payMonth'>
                                    <td>{$row['pay_id']}</td>
                                    <td>" . htmlspecialchars($row2['emp_name']) . "</td>
                                    <td>" . htmlspecialchars($row['total_salary']) . "</td>
                                    <td> 07-" . htmlspecialchars($row['month']) . "-" . htmlspecialchars($row['year']) . " </td>
                                    <td name='payStatus'>". htmlspecialchars($row['status']) . "</td>
                                    <td><button class='btnApproval' " . ($row['status'] === 'Paid' ? 'disabled' : '') . "><a style='text-decoration:underline; " . ($row['status'] === 'Paid' ? 'pointer-events: none; color: grey;' : '') . " ' href='salary_edit.php?value={$row['pay_id']}'>Edit</a></button></td>
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
</body>
</html>

<script>
document.querySelectorAll('input[name="status"]').forEach(radio => {
    radio.addEventListener('change', function () {
        const selectedStatus = this.value.toLowerCase(); // lowercase for comparison
        const rows = document.querySelectorAll('#payrollTable tr');

        rows.forEach(row => {
            const rowClass = row.className.toLowerCase(); // get class like "status-pending"

            if (selectedStatus === 'all' || rowClass.includes('status-' + selectedStatus)) {
                row.style.display = '';
            } 
            else {
                row.style.display = 'none';
            }
        });
    });
});
</script>

<script>
document.getElementById('monthFilter').addEventListener('change', function () {
    const selectedMonth = this.value; // format: YYYY-MM (e.g., 2025-03)
    const rows = document.querySelectorAll('#payrollTable tr');

    rows.forEach(row => {
        const rowMonth = row.getAttribute('data-month');
        
        if (!selectedMonth || selectedMonth === rowMonth) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let rowsPerPage = 10; // Number of rows per page
        let table = document.getElementById("payrollTable");
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







