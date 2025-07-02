<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Style/adminPanel.css">
    <link rel="stylesheet" href="Style/adminEmp.css">
    
</head>
<body>
<?php
    include 'adminPanel.php';
?>

<?php


?>


    <!-- Main Content -->
    
        
    
        <main class="main-content">
        <?php
           include 'adminNav.php';
        ?>  
            

            <section class="employee-section" >
                <div style="display: flex;justify-content : center;">
                <div class="after_nav">
                <h2>Current Employees</h2>
                <a href="add_emp.php"><button class="add-employee">+ Add Employee</button></a>
                </div>
                </div>
                <div class="search-box">
                    <input type="text" id="search" placeholder="Search for a user">
                </div>

                    <table style="margin-top : 20px;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>Salary</th>
                            </tr>
                            
                        </thead>
                        <tbody id="employee-table">
                        <?php

                        // Database connection
                        include 'config.php';


                        // Fetch employee data
                        $query = "SELECT emp_id, emp_name, emp_email , basic_salary FROM employee";
                        $result = mysqli_query($conn, $query);
                        
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {

                                    echo "<tr>
                                            <td>{$row['emp_id']}</td>
                                            <td>" . htmlspecialchars($row['emp_name']) . "</td>
                                            <td>" . htmlspecialchars($row['emp_email']) . "</td>
                                            <td><button class='btnApproval' style='background: none;border: none'><a style='text-decoration: underline;' href='salary_inc.php?value={$row['emp_id']}'>" . htmlspecialchars($row['basic_salary']) . "</a></button></td>
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
            </section>
        </main>
    </div>

    </div>
</body>
</html>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let rowsPerPage = 7; // Number of rows per page
        let table = document.getElementById("employee-table");
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
    document.getElementById("search").addEventListener("keyup", function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#employee-table tr");

        rows.forEach(row => {
            let name = row.cells[1]?.textContent.toLowerCase(); // Get Name column
            let email = row.cells[2]?.textContent.toLowerCase(); // Get Email column

            if (name.includes(filter) || email.includes(filter)) {
                row.style.display = ""; // Show row if it matches
            } else {
                row.style.display = "none"; // Hide row if it doesn't match
            }
        });
    });
</script>



