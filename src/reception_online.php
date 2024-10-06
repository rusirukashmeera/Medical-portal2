<?php
    include_once("config.php");
    session_start();
    $firstName = $_SESSION["firstName"];
    $lastName = $_SESSION["lastName"];
    if(isset($_POST["logout"])){
        session_unset();
        session_destroy();
        header("Location: index.php");
    }
    $sql_doc = "SELECT U.First_Name, U.Last_Name, D.Doctor_Id, D.Specialization FROM user_table U, doctor D WHERE U.Email = D.Email";
    $result_doc = mysqli_query($conn, $sql_doc);
    if(!isset($_SESSION["searchId"])){$_SESSION["searchId"] = "";}
    if(!isset($_SESSION["bookingID"])){$_SESSION["bookingID"] = "";}
    if(!isset($_SESSION["patID"])){$_SESSION["patID"] = "";}
    if(!isset($_SESSION["docID"])){$_SESSION["docID"] = "";}
    if(!isset($_SESSION["date"])){$_SESSION["date"] = "";}
    if(!isset($_SESSION["sessionNo"])){$_SESSION["sessionNo"] = "";}
    if(!isset($_SESSION["gender"])){$_SESSION["gender"] = "";}
    if(!isset($_SESSION["address"])){$_SESSION["address"] = "";}
    if(!isset($_SESSION["patFirstName"])){$_SESSION["patFirstName"] = "";}
    if(!isset($_SESSION["patLastName"])){$_SESSION["patLastName"] = "";}
    if(!isset($_SESSION["contactNo"])){$_SESSION["contactNo"] = "";}
    if(!isset($_SESSION["docFirstName"])){$_SESSION["docFirstName"] = "";}
    if(!isset($_SESSION["docLastName"])){$_SESSION["docLastName"] = "";}
    if(!isset($_SESSION["specialization"])){$_SESSION["specialization"] = "";}
    if(!isset($_SESSION["time"])){$_SESSION["time"] = "";}
    if(isset($_POST["search"])){
        $patID = $_POST["searchId"];
        $_SESSION["searchId"] = $patID;
        if(!empty($patID)){
            $sql_get_patient = "SELECT O.Booking_Id, O.Patient_Id, O.Doctor_Id, O.Date, O.Session_No, P.Gender, P.Address, U.First_Name,
            U.Last_Name, U.Contact_No FROM online_booking O, patient P, user_table U WHERE O.Patient_Id = P.Patient_Id AND P.Email = U.Email AND O.Patient_Id = $patID";
            $result_get_patient = mysqli_query($conn, $sql_get_patient);
            if(mysqli_num_rows($result_get_patient) > 0){
                $row = mysqli_fetch_assoc($result_get_patient);
                $bookingID = $_SESSION["bookingID"] = $row["Booking_Id"];
                $patID = $_SESSION["patID"] = $row["Patient_Id"];
                $docID = $_SESSION["docID"] = $row["Doctor_Id"];
                $date = $_SESSION["date"] = $row["Date"];
                $sessionNo = $_SESSION["sessionNo"] = $row["Session_No"];
                $gender = $_SESSION["gender"] = $row["Gender"];
                $address = $_SESSION["address"] = $row["Address"];
                $patFirstName = $_SESSION["patFirstName"] = $row["First_Name"];
                $patLastName = $_SESSION["patLastName"] = $row["Last_Name"];
                $contactNo = $_SESSION["contactNo"] = $row["Contact_No"];
                switch($_SESSION["sessionNo"]){
                    case 1:
                        $_SESSION["time"] = "7.00 AM";
                        break;
                    case 2:
                        $_SESSION["time"] = "5.00 PM";
                        break;
                    case 3:
                        $_SESSION["time"] = "8.00 PM";
                        break;
                }
                $sql_get_doc = "SELECT U.First_Name, U.Last_Name, D.Specialization FROM doctor D, user_table U WHERE D.Email = U.Email AND D.Doctor_Id = $docID";
                $result_get_doc = mysqli_query($conn, $sql_get_doc);
                if(mysqli_num_rows($result_get_doc) > 0){
                    $row = mysqli_fetch_assoc($result_get_doc);
                    $_SESSION["docFirstName"] = $row["First_Name"];
                    $_SESSION["docLastName"] = $row["Last_Name"];
                    $_SESSION["specialization"] = $row["Specialization"];
                }
            }
        }
    }
    if(isset($_POST["confirm"]) && !empty($_SESSION["patID"])){
        $sql_get_age = "SELECT TIMESTAMPDIFF(YEAR, DOB, CURDATE()) AS Age FROM patient WHERE ".$_SESSION["patID"]." = Patient_Id";
        $result_get_age = mysqli_query($conn, $sql_get_age);
        if(mysqli_num_rows($result_get_age) > 0){
            $row2 = mysqli_fetch_assoc($result_get_age);
            $age = $_SESSION["age"] = $row2["Age"];
        }
        $charge = $_POST["charge"];
        $_SESSION["charge"] = $charge;
        $sql_confirm = "INSERT INTO confirm_booking (Patient_Id, First_Name, Age, Gender, Doctor_Id, Date, Session_No, Type, Charge)
        VALUES (" . $_SESSION["patID"] . ", '" . $_SESSION["patFirstName"] . "', $age, '" . $_SESSION["gender"] . "', " . $_SESSION["docID"] . ", '" . $_SESSION["date"] . "', " . $_SESSION["sessionNo"] . ", 'Online', $charge)";
        $patID = $_SESSION["patID"];
        $sql_delete_booking = "DELETE FROM online_booking WHERE Patient_Id = $patID";
        if(mysqli_query($conn, $sql_confirm)){
            mysqli_query($conn, $sql_delete_booking);
            echo "<script>alert('Appointment confirmed successfully!');
                setTimeout(function() {
                    window.location.href = 'manage_appointments.php';
                }, 1);</script>";
        }
    }
    if(isset($_POST["cancel"]) && !empty($_SESSION["patID"])){
        $patID = $_SESSION["patID"];
        $sql_delete_booking = "DELETE FROM online_booking WHERE Patient_Id = $patID";
        if(mysqli_query($conn, $sql_delete_booking)){
            echo "<script>alert('Appointment deleted successfully!');
                setTimeout(function() {
                    window.location.href = 'manage_appointments.php';
                }, 1);</script>";
        }
    }
    if(isset($_POST["edit"]) && !empty($_SESSION["patID"])){
        header("Location: edit_online.php");
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
            <button id="signupBtn">Sign Out</button>
            <form id="logoutForm" method="POST" action="reception_online.php" style="display: none;">
                <input type="text" value="1" name="logout">
            </form>
        </div>
    </div>
    <div class="content">

        <div class="main">

            <div class="section1">
                
                <form action="#" method="POST">
                    <input type="search" id="searchId" name="searchId" placeholder="Enter Reference Number">
                    <button class="search" type="submit" name="search" onclick="searchPatient();" >Search</button>
                </form>

                <form method="POST">
                    <fieldset class="patientInfo">
                        <legend>Patient Details</Details></legend>
                        <label for="">Name</label>
                        <input class="patient" type="text" name="name" value='<?php if(isset($_POST["search"])){echo $_SESSION["patFirstName"]." ".$_SESSION["patLastName"];} ?>' readonly>  
                        <label for="">Address</label>
                        <input class="patient" type="text" name="address" value='<?php if(isset($_POST["search"])){echo $_SESSION["address"];} ?>' readonly>
                        <label for="">Phone No</label>
                        <input class="patient" type="tel" name="number" value='<?php if(isset($_POST["search"])){echo $_SESSION["contactNo"];} ?>' readonly>
                        <label>
                            <input type="radio" name="gender" value="female" disabled <?php if(isset($_POST["search"])){if($_SESSION["gender"] == "Female"){echo "checked";}} ?>> Female
                        </label>
                        <label >
                            <input type="radio" name="gender" value="male" disabled <?php if(isset($_POST["search"])){if($_SESSION["gender"] == "Male"){echo "checked";}} ?>> Male
                        </label>
                    </fieldset>
                </form>
                
            </div>

            <div class="section2">
                <form action="#" method="POST">
                    <fieldset class="Booking">
                        <legend>Booking Details</legend>
                        
                        <label for="">Doctor</label>
                        <input type="text" class="bookingDetail" style="background-color: #dddddd;" name="docName" id="docName" value='<?php if(isset($_POST["search"])){echo $_SESSION["docFirstName"]." ".$_SESSION["docLastName"]." - ".$_SESSION["specialization"];} ?>' readonly>

                        <label for="">Doctor ID</label>
                        <input type="number" class="bookingDetail" style="background-color: #dddddd;" name="docID" id="docID" value='<?php if(isset($_POST["search"])){echo $_SESSION["docID"];} ?>' readonly>

                        <label for="">Date</label>
                        <input class="bookingDetail" id="date" type="date" value='<?php if(isset($_POST["search"])){echo $_SESSION["date"];} ?>' readonly>

                        <label for="">Time</label>
                        <input type="text" class="bookingDetail" style="background-color: #dddddd;" name="bookingTime" id="bookingTime" value='<?php if(isset($_POST["search"])){echo $_SESSION["time"];} ?>' readonly>

                        <label for="">Charge</label>
                        <input type="number" class="bookingDetail" style="background-color: #dddddd;" name="charge" id="charge" value="0" readonly>
                    
                        <div class="button" >
                            <button class="buttonStyle" id="cancel" type="submit" name="cancel">Cancel Resevation</button>
                            <button class="buttonStyle" id="edit" type="submit" onclick="enableEdit();" name="edit">Edit Resevation</button>
                            <button class="buttonStyle" id="confirm" type="submit" name="confirm">Confirm Resevation</button>
                        </div>
                        
                    </fieldset>
                </form>
                <form >
                    <fieldset class="Billing">
                        <legend>Payment</legend>
                        <label for="HCharge">Hospital Charge</label>
                        <input class="charge" type="text" id="HCharge" name="HCharge" placeholder="Enter Hospital Bill">

                        <label for="DocCharge">Doctor's Payment</label>
                        <input class="charge" type="text" id="DocCharge" name="DocCharge" placeholder="Enter Doctor Bill">

                        <!-- <button class="confirm" id="confirm" type="submit">Confirm Payment</button> -->
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