<?php
    include_once("config.php"); // establishing the database connection

    session_start(); // starting the session

    $firstName = $_SESSION["firstName"];
    $lastName = $_SESSION["lastName"]; // retrieving some user data from session variables

    // sql query to retrieve doctor data
    $sql_doc = "SELECT U.First_Name, U.Last_Name, D.Doctor_Id, D.Specialization FROM user_table U, doctor D WHERE U.Email = D.Email";

    $result_doc = mysqli_query($conn, $sql_doc); // stroing the result after executing the sql query

    include_once("insert_record_offline.php"); // including php file to create records

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
    <title>Receptionist_Offline</title>

    <!-- including css -->
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/receptionist_offline.css">
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
                        echo $firstName." ".$lastName; //echo logged in user's details
                    ?></label><br>
                    <label class="accType">Receptionist</label>
                </div>
            </div>
        </header>

        <!-- navigation bar -->
        <div class="navbar" id="navbar">
            <ul class="options">
                <li><a href="manage_appointments.php">Manage Appointments</a></li>
                <li><a href="reception_online.php">Online Booking</a></li>
                <li><a href="#" class="active">Offline Booking</a></li>
            </ul>
            <button id="signupBtn" name="signupBtn">Sign Out</button>
            <form id="logoutForm" method="POST" action="receptionist_offline.php" style="display: none;">
                <input type="text" value="1" name="logout">
            </form>
        </div>
    </div>

    <!-- main content div -->
    <div class="content" id="content">
        <div class="offlineBookingDiv">

            <!-- form to submit booking details, divs are used for alignment using css -->
            <form class="offlineBooking" action="receptionist_offline.php" method="GET">
                <div class="leftContent">
                    <div class="leftContentTop">
                        <fieldset>
                            <legend class="bookingTopics">Patient Details</legend>
                            <label for="" class="bookingLbls">Patient Name</label><br>
                            <input type="text" class="bookingVals" name="patName" required><br><br>
                            <label for="" class="bookingLbls">Patient Age</label><br>
                            <input type="number" class="bookingVals" name="patAge" min="1" max="150" required><br><br>
                            <label for="" class="bookingLbls">Patient Gender</label><br>
                            <input type="radio" name="gender" value="Male"><label for="" class="bookingLbls" checked>Male</label>
                            <input type="radio" name="gender" value="Female"><label for="" class="bookingLbls">Female</label>
                        </fieldset>
                    </div>
                    <div class="leftContentBottom">
                        <fieldset>
                            <legend class="bookingTopics">Payment</legend>
                            <label for="" class="bookingLbls" min="0">Hospital Charge</label><br>
                            <input type="number" class="bookingVals" id="hospCharge"><br><br>
                            <label for="" class="bookingLbls" min="0">Doctor's Charge</label><br>
                            <input type="number" class="bookingVals" id="docCharge"><br><br>
                        </fieldset>
                    </div>
                </div>
                <div class="rightContent">
                    <fieldset style="padding-bottom: 23px;">
                        <legend class="bookingTopics">Booking Details</legend>
                        <label for="" class="bookingLbls" name="">Select Doctor</label><br>
                        <select name="" id="docs" class="bookingVals">
                            <?php
                                if(mysqli_num_rows($result_doc) > 0){
                                    while($row = mysqli_fetch_assoc($result_doc)){
                                        $firstName = $row["First_Name"];
                                        $lastName = $row["Last_Name"];
                                        $docID = $row["Doctor_Id"];
                                        $spec = $row["Specialization"];
                                        echo "<option value=\"$docID\">$firstName $lastName - $spec</option>";
                                    }
                                } //display all the doctor details fetched from the database
                            ?>
                        </select><br><br>
                        <label for="" class="bookingLbls">Doctor ID</label><br>
                        <input type="number" class="bookingVals" style="background-color: #dddddd;" name="docID" id="docID" readonly><br><br>
                        <label for="" class="bookingLbls">Select Date</label><br>
                        <input type="date" class="bookingVals" id="dateX" name="dateX" required><br><br>
                        <label for="" class="bookingLbls">Select from an available time slot</label><br>
                        <select name="timeX" id="timeX" class="bookingVals">
                            <option value="1">7.00 AM</option>
                            <option value="2">5.00 PM</option>
                            <option value="3">8.00 PM</option> 
                        </select><br><br>
                        <label for="" class="bookingLbls">Total Charge: </label>
                        <input type="number" class="bookingVals" id="totalCharge" name="totalCharge" value="0" style="width: 73%; background-color: #dddddd;" readonly><br><br>
                        <div class="bookingBtns">
                            <button id="bookingBtn1" name="bookingBtn1" type="reset">Cancel Reservation</button>
                            <button id="bookingBtn2" name="bookingBtn2" type="submit">Confirm Reservation</button>
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>
    </div>

    <!-- footer -->
    <footer class="footerX">
        <p>Lifeline Healthcare &copy; 2024. All rights reserved.</p>
    </footer>

    <!-- including javascript -->
    <script src="js/script.js"></script>
    <script src="js/receptionist_offline.js"></script>
    <script src="js/signout.js"></script>
</body>
</html>