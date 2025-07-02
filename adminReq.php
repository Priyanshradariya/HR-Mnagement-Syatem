<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Style/adminPanel.css">
    <link rel="stylesheet" href="Style/adminRequest.css">
    <script src="script.js" defer></script>
</head>
<style>
    .btnApproval{
        background: transparent; /* No background */
        border: none;
    }

    .btnApproval a{
        color:rgb(168, 92, 30);
    }

</style>
<body>

 

    <?php
    include 'adminPanel.php';
    ?>
    <!-- Main Content -->
    <div class="main-content">
        <?php
        include 'adminNav.php';
        ?>

        <div class="container">
            

            <h2>Current Requests</h2>

            <table style="margin-top : 20px;">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>CREATED BY</th>
                            <th>TYPE</th>
                            <th>START DATE</th>
                            <th>END DATE</th>
                            <th>Reason</th>
                            <th>STATUS</th>
                            </tr>
                            
                        </thead>
                        <tbody id="employee-table">
                        <?php

                        // Database connection
                        include 'config.php';


                        // Fetch employee data
                        $query = "SELECT * FROM leave_req ";
                        $result = mysqli_query($conn, $query);
                        
                        
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {

                                    $user_id = $row['created_by'];
                                    $qu2 = "SELECT first_name FROM users WHERE id = '$user_id'";
                                    $res = mysqli_query($conn, $qu2);                   
                                    $rw = mysqli_fetch_assoc($res); // Fetch data as an associative array
                                    $first_name = $rw['first_name'];
                                    $rowId = "msgPopup_" . $row['leave_id'];
                                    
                                    
                                    echo "<tr>
                                        <td>{$row['leave_id']}</td>
                                        <td>" . htmlspecialchars($first_name) . "</td>
                                        <td>" . htmlspecialchars($row['type']) . "</td>
                                        <td>" . htmlspecialchars($row['start_date']) . "</td>
                                        <td>" . htmlspecialchars($row['end_date']) . "</td>
                                        <td>
                                            <span class='reason_link' onclick='toggleMessage(\"$rowId\")' id='viewReason' style='cursor: pointer; color:rgb(30, 124, 168);; text-decoration: underline;'>View Reason</span>
                                        </td>
                                        <td><button class='btnApproval'><a href='add_permit.php?value={$row['leave_id']}'>" . htmlspecialchars($row['status']) . "</a></button></td>
                                    </tr>
                                    
                                    <tr id='$rowId'   >
                                        <td colspan='7'  style='background:rgb(0, 0, 0); padding: 10px ;display : none;  max-width: 400px;
                                               overflow-wrap: break-word; vertical-align: top;'>
                                            <strong>Reason:</strong> " . htmlspecialchars($row['message']) . "
                                        </td>
                                    </tr>";
                                }
                            }
                            $conn->close();
                        ?>
                        </tbody>
                    </table>

            <div class="pagination">
                <button id="prevPage">❮</button>
                <span id="pageNumber" style="margin-top: 11px; padding: 0px 10px;">1</span>
                <button id="nextPage">❯</button>
            </div>

        </div>




    </div>
</body>

</html>

<script>
        // function toggleMessagePopup() {
        //     document.getElementById("msgPopup").style.display = "block";
        // }

        // function closePopup() {
        //     document.getElementById("msgPopup").style.display = "none";
        // }

        // function msgOk() {
        //     // Add your actual logout logic here
        //     closePopup();
        //     window.location.href = "adminReq.php";

            
        // }

        
        
    function toggleMessage(rowId) {
        let row = document.getElementById(rowId);

        if (row.cells[0].style.display == "none" || row.cells[0].style.display == "") {
            row.style.display = "table-row";
            row.cells[0].style.display = "table-cell";
            
        } else {
            row.style.display = "none";
            row.cells[0].style.display = "none";
        }   
            
    }

    function changeTextColor(button, status) {
        let textElement = button.querySelector("a"); // Get the <a> tag inside the button

        if (status === "Approved") {
            textElement.style.color = "green";
        } else if (status === "Rejected") {
            textElement.style.color = "red";
        } else if (status === "Pending") {
            textElement.style.color = "orange";
        }
    }
    
</script>





<script>
    document.addEventListener("DOMContentLoaded", function () {
        let rowsPerPage = 14; // Number of rows per page
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