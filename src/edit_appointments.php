<?php
    include_once("config.php");
    session_start();
    $firstName = $_SESSION["firstName"];
    $lastName = $_SESSION["lastName"];
    $sql_doc = "SELECT U.First_Name, U.Last_Name, D.Doctor_Id, D.Specialization FROM user_table U, doctor D WHERE U.Email = D.Email";
    $result_doc = mysqli_query($conn, $sql_doc);
    $sql_get_apps = "SELECT C.Appointment_Id, C.First_Name AS Pat_Name, C.Age, C.Gender, U.First_Name AS Doc_Name, C.Date, C.Session_No, C.Charge
    FROM confirm_booking C, doctor D, user_table U WHERE C.Doctor_Id = D.Doctor_Id AND D.Email = U.Email";
    $result_get_apps = mysqli_query($conn, $sql_get_apps);
    $e_appID = $_GET["appID"];
    $_SESSION["appID"] = $e_appID;
    $e_patName = $_GET["patName"];
    $e_age = $_GET["age"];
    $e_gender = $_GET["gender"];
    $e_docName = $_GET["docName"];
    $e_dateX = $_GET["dateX"];
    $e_timeX = $_GET["timeX"];
    $e_charge = $_GET["charge"];
    //mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage_Appointments</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/manage_appointments.css">
    <link rel="stylesheet" href="styles/receptionist_offline.css">
</head>
<body>
    <div class="tops">
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
        <div class="navbar" id="navbar">
            <ul class="options">
                <li><a href="#" class="active">Manage Appointments</a></li>
                <li><a href="reception_online.php">Online Booking</a></li>
                <li><a href="receptionist_offline.php">Offline Booking</a></li>
            </ul>
            <button id="signupBtn" name="signupBtn">Sign Out</button>
            <form id="logoutForm" method="POST" action="receptionist_offline.php" style="display: none;">
                <input type="text" value="1" name="logout">
            </form>
        </div>
    </div>
    <div class="content" id="content">
    <?php
        echo "<center><h2>Edit Appointment - $e_appID</h2><center>";
    ?>
    <div class="offlineBookingDiv">
            <form class="offlineBooking" action="process_edit.php" method="GET">
                <div class="leftContent">
                    <div class="leftContentTop">
                        <fieldset>
                            <legend class="bookingTopics">Patient Details</legend>
                            <label for="" class="bookingLbls">Patient Name</label><br>
                            <input type="text" class="bookingVals" name="patName" value="<?php echo $e_patName; ?>" required><br><br>
                            <label for="" class="bookingLbls">Patient Age</label><br>
                            <input type="number" class="bookingVals" name="patAge" min="1" max="150" value="<?php echo $e_age; ?>" required><br><br>
                            <label for="" class="bookingLbls">Patient Gender</label><br>
                            <input type="radio" name="gender" value="Male" checked><label for="" class="bookingLbls">Male</label>
                            <input type="radio" name="gender" value="Female"><label for="" class="bookingLbls">Female</label>
                        </fieldset>
                    </div>
                    <div class="leftContentBottom">
                        <fieldset>
                            <legend class="bookingTopics">Payment</legend>
                            <label for="" class="bookingLbls">Hospital Charge</label><br>
                            <input type="number" class="bookingVals" id="hospCharge"><br><br>
                            <label for="" class="bookingLbls">Doctor's Charge</label><br>
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
                                }
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
                            <button id="bookingBtn3" name="bookingBtn3">Edit Reservation</button>
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>
    </div>
    <footer class="footerX">
        <p>Lifeline Healthcare &copy; 2024. All rights reserved.</p>
    </footer>
    <script src="js/script.js"></script>
    <script src="js/receptionist_offline.js"></script>
</body>
</html>