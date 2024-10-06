<?php
    include_once("config.php");
    session_start();
    $firstName = $_SESSION["firstName"];
    $lastName = $_SESSION["lastName"];
    $appID = $_SESSION["appID"];
    $docID = $_SESSION["docID"];
    $date = $_SESSION["date"];
    $time = $_SESSION["time"];
    $sql_get_doc = "SELECT U.First_Name, U.Last_Name FROM user_table U, doctor D WHERE D.Doctor_Id = $docID AND D.Email = U.Email";
    $result_get_doc = mysqli_query($conn, $sql_get_doc);
    if(mysqli_num_rows($result_get_doc) > 0){
        $row = mysqli_fetch_assoc($result_get_doc);
        $docFirstName = $row["First_Name"];
        $docLastName = $row["Last_Name"];
    }
    if(isset($_POST["save"])){
        $date = $_POST["date"];
        $time = $_POST["time"];
        $sql_update_booking = "UPDATE online_booking SET Date = '$date', Session_No = $time WHERE Booking_Id = $appID";
        if(mysqli_query($conn, $sql_update_booking)){
            echo "<script>alert('Channeling with booking id $appID updated successfully!');
            setTimeout(function() {
                    window.location.href = 'channeling.php';
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
                <img class="avatar" src="images/avatar.png" alt="Generic Avatar">
                <div class="accInfo">
                    <label class="accName"><?php echo $firstName." ".$lastName ?></label><br>
                    <label class="accType">Patient</label>
                </div>
            </div>
        </header>
        <div class="navbar">
            <ul class="options">
                <li><a href="#">Home</a></li>
                <li><a href="#">Our Services</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="#" class="active">Channeling</a></li>
            </ul>
            <button id="signupBtn">Sign Up</button>
        </div>
    </div>

    <div class="content" style="min-height: 150vh;">
        <main class="content">
            <div class="channeling-container">
                <!-- Left Section -->
                <div class="left-section">
                    <img src="images/doctors.jpg" alt="Appointment Image" width="500" height="400">
                </div>

                <!-- Right Section -->
                <div class="right-section">
                    <div class="channeling-details">
                        <h1>Channeling Details</h1>
                        <form method="POST" style="outline-style: double; outline-width: 2px; outline-color: black;">
                            <label for="Appointment-ID">Booking ID:</label>
                            <input class="details" type="text" id="Appointment-ID" value='<?php echo $appID ?>' disabled>

                            <label for="doctor">Doctor:</label>
                            <input class="details" type="text" id="doctor" name="doctor" value='<?php echo $docFirstName." ".$docLastName ?>' disabled>

                            <label for="Doctor-ID">Doctor ID:</label>
                            <input class="details" type="text" id="Doctor-ID" name="Doctor-ID" value='<?php echo $docID ?>' readonly>

                            <label for="date">Select Date:</label>
                            <input class="details" type="date" id="date" name="date" value='<?php echo $date ?>' disabled>

                            <label for="time-slot">Select from an Available Time Slot:</label>
                            <div class="time-slot-options">
                                <input type="radio" id="slot1" name="time" <?php if($time == 1){echo 'checked';} ?> value="1" disabled>
                                <label for="slot1">7.00 AM</label>

                                <input type="radio" id="slot2" name="time" <?php if($time == 2){echo 'checked';} ?> value="2" disabled>
                                <label for="slot2">5.00 PM</label>

                                <input type="radio" id="slot3" name="time" <?php if($time == 3){echo 'checked';} ?> value="3" disabled>
                                <label for="slot3">8.00 PM</label>
                            </div><br>
                            <button class="edit" type="submit" name="edit">EDIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <footer class="footerX">
        <p>Lifeline Healthcare &copy; 2024. All rights reserved.</p>
    </footer>

    <script src="js/edit_channeling.js"></script>

</body>
</html>
