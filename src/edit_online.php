<?php
    include_once("config.php");
    session_start();
    $firstName = $_SESSION["firstName"];
    $lastName = $_SESSION["lastName"];
    $sql_doc = "SELECT U.First_Name, U.Last_Name, D.Doctor_Id, D.Specialization FROM user_table U, doctor D WHERE U.Email = D.Email";
    $result_doc = mysqli_query($conn, $sql_doc);
    if(isset($_POST["edit"])){
        $date = $_POST["date"];
        $bookingTime = $_POST["bookingTime"];
        $patID = $_SESSION["patID"];
        $sql_edit_booking = "UPDATE online_booking SET Date = '$date', Session_No = $bookingTime WHERE Patient_Id = $patID";
        if(mysqli_query($conn, $sql_edit_booking)){
            echo "<script>alert('Booking edited successfully!');
                setTimeout(function() {
                    window.location.href = 'manage_appointments.php';
                }, 1);</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEDPORTAL</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/reception_online.css">
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
                    <label class="accName"><?php echo $firstName." ".$lastName ?></label><br>
                    <label class="accType">Receptionist</label>
                </div>
            </div>
        </header>
        <div class="navbar">
            <ul class="options">
                <li><a href="manage_appointments.php">Manage Appointments</a></li>
                <li><a href="#" class="active">Online Booking</a></li>
                <li><a href="receptionist_offline.php">Offline Booking</a></li>
            </ul>
            <button id="signupBtn">Sign Up</button>

        </div>
    </div>
    <div class="content">

        <div class="main">

            <div class="section1">

                <form method="POST">
                    <br><br>
                    <fieldset class="patientInfo">
                        <legend>Patient Details</Details></legend>
                        <label for="">Name</label>
                        <input class="patient" type="text" name="name" value='<?php echo $_SESSION["patFirstName"]." ".$_SESSION["patLastName"]; ?>' readonly>  
                        <label for="">Address</label>
                        <input class="patient" type="text" name="address" value='<?php echo $_SESSION["address"]; ?>' readonly>
                        <label for="">Phone No</label>
                        <input class="patient" type="tel" name="number" value='<?php echo $_SESSION["contactNo"]; ?>' readonly>
                        <label>
                            <input type="radio" name="gender" value="female" <?php if($_SESSION["gender"] == "Female"){echo "checked";} ?> disabled> Female
                        </label>
                        <label >
                            <input type="radio" name="gender" value="male" <?php if($_SESSION["gender"] == "Male"){echo "checked";} ?> disabled> Male
                        </label>
                    </fieldset>
                </form>
                
            </div>

            <div class="section2">
                <form action="#" method="POST">
                    <fieldset class="Booking">
                        <legend>Booking Details</legend>
                        
                        <label for="">Doctor</label>
                        <input type="text" class="bookingDetail" style="background-color: #dddddd;" name="docName" id="docName" value='<?php echo $_SESSION["docFirstName"]." ".$_SESSION["docLastName"]." - ".$_SESSION["specialization"]; ?>' readonly>

                        <label for="">Doctor ID</label>
                        <input type="number" class="bookingDetail" style="background-color: #dddddd;" name="docID" id="docID" value='<?php echo $_SESSION["docID"]; ?>' readonly>

                        <label for="">Date</label>
                        <input class="bookingDetail" name="date" id="date" type="date" value='<?php echo $_SESSION["date"]; ?>'>

                        <label for="">Time</label>
                        <!-- <input type="text" class="bookingDetail" name="bookingTime" id="bookingTime" value='<?php echo $_SESSION["time"]; ?>'> -->
                        <select name="bookingTime" id="bookingTime" class="bookingDetail">
                            <option value="1">7.00 AM</option>
                            <option value="2">5.00 PM</option>
                            <option value="3">8.00 PM</option>  
                        </select>
                    
                        <div class="button" >
                            
                            <button class="buttonStyle" id="edit" type="submit" onclick="enableEdit();" name="edit">Save Resevation</button>
                            
                        </div>
                        
                    </fieldset>
                </form>
            </div>
        </div>

    </div>
    <footer class="footerX">
        <p>Lifeline Healthcare &copy; 2024. All rights reserved.</p>
    </footer>
    <script src="js/receptionist_online.js"></script>
</body>
</html>