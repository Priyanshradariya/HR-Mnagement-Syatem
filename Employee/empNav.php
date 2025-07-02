<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/adminPanel.css">
    <title>Document</title>
</head>
<style>
    .logout {

        padding: 8px 36px;
        border-radius: 10px;
        font-size: 15px;
        color: white;
        font-weight: bold;
        background: linear-gradient(135deg, #ff512f, #dd2476);
    }

    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

    .logout:hover {
        background-color: #7c2ae8;

        background: linear-gradient(135deg, #dd2476, #ff512f);
    }

    .popup {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
  }

  .popup-content {
    background-color: white;
    margin: 15% auto;
    padding: 20px;
    border-radius: 5px;
    width: 345px;
  }

  .yes_b
  {
    padding: 10px 30px;
    color: white;
    background:rgb(0, 153, 255);
    border-radius: 30px;
    border: 0;
    font-weight: 800;
  }

  .no_b{
    color: rgb(0, 153, 255);
    border: 0;
    background: none;
    border-radius: 30px;
    font-weight: 800;
    padding: 10px 30px;
  }

  .yes_b:hover{
    background: rgb(0, 106, 255);
  }

  .no_b:hover{
    background: rgba(133, 138, 147, 0.13);
  }

</style>

<body>

    <header>
        <a href="javascript:history.back()"><button class="back-btn">← Go Back</button></a>
        <h1><?php

        if (isset($_GET['name'])) {
            $name = $_GET['name'];
            echo $name;
        } else {
            echo 'Dashboard';
        }

        ?></h1>
        <div>
            <button class="logout" onclick="toggleLogoutPopup()">Log out</button>
            <div id="logoutPopup" class="popup">
                <div class="popup-content">
                    <p style="    color: black;font-size: 20px;font-weight: 600;">Are you sure you want to logout?</p>
                    <button onclick="confirmLogout()" class="yes_b">Yes</button>
                    <button onclick="closePopup()" class="no_b">No</button>
                </div>
            </div>
        </div>

    </header>

    <script>
        function toggleLogoutPopup() {
            document.getElementById("logoutPopup").style.display = "block";
        }

        function closePopup() {
            document.getElementById("logoutPopup").style.display = "none";
        }

        function confirmLogout() {
            // Add your actual logout logic here
            closePopup();
            window.location.href = "../logout.php";

            
        }
    </script>
</body>

</html>