<?php
    include_once("config.php");
    session_start();
    $firstName = $_SESSION["firstName"];
    $lastName = $_SESSION["lastName"];
    $sql_doc = "SELECT U.First_Name, U.Last_Name, D.Doctor_Id, D.Specialization FROM user_table U, doctor D WHERE U.Email = D.Email";
    $result_doc = mysqli_query($conn, $sql_doc);
    $patEmail = $_SESSION["email"];
    $sql_get_patID = "SELECT Patient_Id FROM patient WHERE Email = '$patEmail'";
    $result_get_patID = mysqli_query($conn, $sql_get_patID);
    if(mysqli_num_rows($result_get_patID) > 0){
        $row = mysqli_fetch_assoc($result_get_patID);
        $patID = $row["Patient_Id"];
    }
    if(isset($_POST["channel"])){
        $docID = $_SESSION["docID"] = $_POST["Doctor-ID"];
        $date = $_SESSION["date"] = $_POST["date"];
        $time = $_SESSION["time"] = $_POST["time"];
        $_SESSION["patID"] = $patID;
        $sql_create_booking = "INSERT INTO online_booking (Patient_Id, Doctor_Id, Date, Session_No) VALUES ($patID, $docID, '$date', $time)";
        if(mysqli_query($conn, $sql_create_booking)){
            $sql_get_appID = "SELECT MAX(Booking_Id) AS Max_Id FROM online_booking";
            $result_get_appID = mysqli_query($conn, $sql_get_appID);
            if(mysqli_num_rows($result_get_appID)){
                $row2 = mysqli_fetch_assoc($result_get_appID);
                $appID = $_SESSION["appID"] = $row2["Max_Id"];
            }
            echo "<script>alert('Doctor channelled successfully with booking id $appID!');
            setTimeout(function() {
                    window.location.href = 'edit_channeling.php';
                }, 1);</script>";
        }
    }
    if(isset($_POST["logout"])){
        session_unset();
        session_destroy();
        mysqli_close($conn);
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEDPORTAL</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/channeling.css">
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
                <a href="edit_profile.php"><img class="avatar" src="images/avatar.png" alt="Generic Avatar"></a>
                <div class="accInfo">
                    <label class="accName"><?php echo $firstName." ".$lastName ?></label><br>
                    <label class="accType">Patient</label>
                </div>
            </div>
        </header>
        <div class="navbar">
            <ul class="options">
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Our Services</a></li>
                <li><a href="about_us.php">About Us</a></li>
                <li><a href="new_contact.php">Contact Us</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="#" class="active">Channeling</a></li>
            </ul>
            <button id="signupBtn">Sign Out</button>
            <form id="logoutForm" method="POST" action="#" style="display: none;">
                <input type="text" value="1" name="logout">
            </form>
        </div>
    </div>

    <div class="content" style="min-height: 120vh;">
        <div class="contentX">
            <div class="channeling-container">
                <!-- Left Section -->
                <div class="left-section">
                    <img src="images\doctors.jpg" alt="Appointment Image"  width="500" height="400">
                    
                </div>

                <!-- Right Section -->
                <div class="right-section">
                    <div class="channeling-details">
                        <h1>Channeling Details</h1>
                        <form style="outline-style: double; outline-width: 2px; outline-color: black;" action="" method="POST">

                            <label for="doctor">Select Doctor:</label>
                            <select id="doctor">
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
                            </select>

                            <label for="Doctor-ID">Doctor ID:</label>
                            <input class="details" type="text" id="Doctor-ID" name="Doctor-ID" value="XXXXXXXXXXXXXXX" readonly>


                            <label for="date">Select Date:</label>
                            <input class="details" type="date" id="date" name="date">

                            <label for="time-slot">Select from an Available Time Slot:</label>
                            
                            <div class="time-slot-options">
                                <input type="radio" id="slot1" name="time" value="1">
                                <label for="slot1">7.00 AM</label>

                                <input type="radio" id="slot2" name="time" value="2">
                                <label for="slot2">5.00 PM</label>

                                <input type="radio" id="slot3" name="time" value="3">
                                <label for="slot3">8.00 PM</label>
                            </div>
                            
                            <button class="channel" id="channel" type="submit" name="channel">CHANNEL DOCTOR</button><br>
                       
                        </form>
                    </div>
                        
                </div>
            </div>
            
        </div>
               
    </div>

    <footer class="footerX">
        <p>Lifeline Healthcare &copy; 2024. All rights reserved.</p>
    </footer>

    <script src="js/channeling.js"></script>
    <script src="js/signout.js"></script>
    
</body>
</html>
