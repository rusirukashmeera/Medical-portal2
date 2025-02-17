<?php
    include_once("config.php"); //establishing database connection

    session_start(); //starting the session

    $firstName = $_SESSION["firstName"];
    $lastName = $_SESSION["lastName"]; // retrieving some user data from session variables

    // sql query to get appointment details
    $sql_get_apps = "SELECT C.Appointment_Id, C.First_Name AS Pat_Name, C.Age, C.Gender, U.First_Name AS Doc_Name, C.Date, C.Session_No, C.Charge
    FROM confirm_booking C, doctor D, user_table U WHERE C.Doctor_Id = D.Doctor_Id AND D.Email = U.Email ORDER BY C.Appointment_Id";
    
    $result_get_apps = mysqli_query($conn, $sql_get_apps); // storing the result after executing the sql query

    if(isset($_POST["logout"])){
        session_unset();
        session_destroy();
        mysqli_close($conn);
        header("Location: index.php");
    } // logout only if logout form is submitted via js (js script gets executed on click of a button)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage_Appointments</title>

    <!-- inserting css -->
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/manage_appointments.css">
</head>
<body>
    <div class="tops">

        <!-- header -->
        <header class="headerX">
            <img class="logo" src="images/logo2.png" alt="MEDPORTAL Logo">
            <div class="title">
                <div>
                    <h3 class="title-text" style="font-size: 25px; margin-bottom: 5px;">Lifeline Healthcare</h3>
                    <h1 class="title-text" style="font-size: 40px; margin-top: 0;">MEDPORTAL</h1>
                </div>
            </div>
            <div class="profile">
                <img class="avatar" src="images/avatar.png" alt="Generic Avatar">
                <div class="accInfo">
                    <label class="accName"><?php
                        echo $firstName." ".$lastName;
                    ?></label><br>
                    <label class="accType">Receptionist</label>
                </div>
            </div>
        </header>

        <!-- navigation bar -->
        <div class="navbar" id="navbar">
            <ul class="options">
                <li><a href="#" class="active">Manage Appointments</a></li>
                <li><a href="reception_online.php">Online Booking</a></li>
                <li><a href="receptionist_offline.php">Offline Booking</a></li>
            </ul>
            <button id="signupBtn" name="signupBtn">Sign Out</button>
            <form id="logoutForm" method="POST" action="manage_appointments.php" style="display: none;">
                <input type="text" value="1" name="logout">
            </form>
        </div>
    </div>

    <!-- main content -->
    <div class="content" id="content">
        <div class="appDiv">
            <center>
                <h2>Appointment Details</h2>
            </center>
            <center>
                <table class="appTable">
                    <tr>
                        <th>Appointment ID</th>
                        <th>Patient Name</th>
                        <th>Patient Age</th>
                        <th>Patient Gender</th>
                        <th>Doctor Name</th>
                        <th>Date</th>
                        <th>Session No</th>
                        <th>Total Charge</th>
                        <th>Edit or Delete</th>
                    </tr>
                    <?php
                        if(mysqli_num_rows($result_get_apps) > 0){
                            while($row = mysqli_fetch_assoc($result_get_apps)){
                                $appID = $row["Appointment_Id"];
                                $patName = $row["Pat_Name"];
                                $age = $row["Age"];
                                $gender = $row["Gender"];
                                $docName = $row["Doc_Name"];
                                $dateX = $row["Date"];
                                $timeX = $row["Session_No"];
                                $charge = $row["Charge"]; //storing row variables in local variables for easier echo syntax

                                echo "<tr >
                            <td>$appID</td>
                            <td>$patName</td>
                            <td>$age</td>
                            <td>$gender</td>
                            <td>$docName</td>
                            <td>$dateX</td>
                            <td>$timeX</td>
                            <td>$charge</td>
                            <td>
                            <a href='edit_appointments.php?appID=".$appID."&patName=".$patName."&age=".$age."&gender=".$gender."
                            &docName=".$docName."&dateX=".$dateX."&timeX=".$timeX."&charge=".$charge."'>Edit</a>
                            <a href='delete_appointments.php?appID=".$appID."'>Delete</a>
                            </td>
                        </tr>"; //creates a row in html table
                            } //iterates through all the records in result
                        } //executes only if there are any records in the result
                    ?>
                </table>
            </center>
        </div>
    </div>

    <!-- footer -->
    <footer class="footerX">
        <p>Lifeline Healthcare &copy; 2024. All rights reserved.</p>
    </footer>

    <!-- inserting javascript -->
    <script src="js/script.js"></script>
    <script src="js/signout.js"></script>
</body>
</html>