<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../E_Style/empPay.css">
    
    <title>Document</title>
</head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

th, td {
    padding: 10px;
    border-bottom: 1px solid #444;
    text-align: left;
}

th {
    background-color: #222B40;
}

td a {
    color: #8AB4F8;
    cursor: pointer;
    text-decoration: none;
}

td a:hover {
    text-decoration: underline;
}   
</style>
<body>
    <?php
    session_start();
     require("empPanel.php");
    ?>

<div class="main-content">
    <?php
           include 'empNav.php';
    ?>  

<div class="container">
        <div class="payroll-card" style="    width: 141%;margin-left: -147px;">
            <h2>Payrolls</h2>

            <div class="date_status">
            <!-- Filter by Month -->
            <div class="filter-section">
                <label for="monthFilter">Filter by Month:</label>
                <input type="month" id="monthFilter">
            </div>

            <!-- Filter by Status -->
            <div class="filter-section">
                <label class="status_lable">Filter by Status:</label>
                <div class="status-filters">
                    <label class="radio-container">
                        <input type="radio" name="status" value="All" checked> All
                    </label>
                    <label class="radio-container">
                        <input type="radio" name="status" value="Pending"> Pending
                    </label>
                    <label class="radio-container">
                        <input type="radio" name="status" value="Reviewed"> Reviewed
                    </label>
                    <label class="radio-container">
                        <input type="radio" name="status" value="Paid"> Paid
                    </label>
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
                    
                </tr>
            </thead>
            <tbody id="payrollTable">
            <?php

                // Database connection
                include '../config.php';
                $user_id = $_SESSION['id'];

                // Fetch employee data
                $query = "SELECT * FROM payroll where employee_id = '$user_id'";
                $result = mysqli_query($conn, $query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                            $query2 = "SELECT emp_name,emp_id FROM employee WHERE emp_id = '".$row['employee_id']."'";
                            $result2 = mysqli_query($conn, $query2);
                            $row2 = $result2->fetch_assoc();
                            $payMonth = $row['year']-$row['month'];
                            echo "<tr class='status-".trim($row['status'])."' data-month='$payMonth'>
                                    <td>{$row['pay_id']}</td>
                                    <td>" . htmlspecialchars($row2['emp_name']) . "</td>
                                    <td>" . htmlspecialchars($row['total_salary']) . "</td>
                                    <td> 07-" . htmlspecialchars($row['month']) . "-" . htmlspecialchars($row['year']) . " </td>
                                    <td name='payStatus'>". htmlspecialchars($row['status']) . "</td>
                                </tr>";
                        }
                    }
                    $conn->close();
                ?>
            </tbody>
        </table>
        </div>
        
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