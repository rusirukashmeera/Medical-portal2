<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEDPORTAL</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/receptionist_offline.css">
</head>
<body>
    <div class="tops">
        <header class="headerX">
            <img class="logo" src="images/logo2.png" alt="MEDPORTAL Logo">
            <div class="title">
                <div>
                    <h3 style="font-size: 25px; margin-bottom: 5px; color: #ffffff;">Lifeline Healthcare</h3>
                    <h1 style="font-size: 40px; margin-top: 0; color: #ffffff;">MEDPORTAL</h1>
                </div>
            </div>
            <div class="profile">
                <img class="avatar" src="images/avatar.png" alt="Generic Avatar">
                <div class="accInfo">
                    <label class="accName"><?php
                        if (isset($_SESSION["email"])){
                            echo $_SESSION["email"];
                        }
                        else{
                            echo "Guest";
                        }
                    ?></label><br>
                    <label class="accType">Administrator</label>
                </div>
            </div>
        </header>
        <div class="navbar" id="navbar">
            <ul class="options">
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Our Services</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Online Booking</a></li>
                <li><a href="#" class="active">Offline Booking</a></li>
            </ul>
            <button class="signupBtn">Sign Up</button>
        </div>
    </div>
    <div class="content" id="content">
        <div class="offlineBookingDiv">
            <form class="offlineBooking" action="">
                <div class="leftContent">
                    <div class="leftContentTop">
                        <fieldset>
                            <legend class="bookingTopics">Patient Details</legend>
                            <label for="" class="bookingLbls">Patient Name</label><br>
                            <input type="text" class="bookingVals"><br><br>
                            <label for="" class="bookingLbls">Patient Age</label><br>
                            <input type="number" class="bookingVals"><br><br>
                            <label for="" class="bookingLbls">Patient Gender</label><br>
                            <input type="radio" name="gender"><label for="" class="bookingLbls">Male</label>
                            <input type="radio" name="gender"><label for="" class="bookingLbls">Female</label>
                        </fieldset>
                    </div>
                    <div class="leftContentBottom">
                        <fieldset>
                            <legend class="bookingTopics">Payment</legend>
                            <label for="" class="bookingLbls">Hospital Charge</label><br>
                            <input type="number" class="bookingVals" value="0" id="hospCharge"><br><br>
                            <label for="" class="bookingLbls">Doctor's Charge</label><br>
                            <input type="number" class="bookingVals" value="0" id="docCharge"><br><br>
                        </fieldset>
                    </div>
                </div>
                <div class="rightContent">
                    <fieldset style="padding-bottom: 23px;">
                        <legend class="bookingTopics">Booking Details</legend>
                        <label for="" class="bookingLbls">Select Specialty</label><br>
                        <select name="" id="" class="bookingVals">
                            <option value="Cardiologist">Cardiologist</option>
                            <option value="Neurologist">Neurologist</option>
                            <option value="Oncologist">Oncologist</option>
                            <option value="Dermatologist">Dermatologist</option>
                            <option value="Psychiatrist">Psychiatrist</option>
                        </select><br><br>
                        <label for="" class="bookingLbls">Select Doctor</label><br>
                        <select name="" id="" class="bookingVals">
                            <option value="Dr. Levi Ackerman">Dr. Levi Ackerman</option>
                            <option value="Dr. Mikasa Ackerman">Dr. Mikasa Ackerman</option>
                            <option value="Dr. Eren Jaeger">Dr. Eren Jaeger</option>
                            <option value="Dr. Sasha Blouse">Dr. Sasha Blouse</option>
                            <option value="Dr. Erwin Smith">Dr. Erwin Smith</option>
                        </select><br><br>
                        <label for="" class="bookingLbls">Select Date</label><br>
                        <input type="date" class="bookingVals"><br><br>
                        <label for="" class="bookingLbls">Select from an available time slot</label><br>
                        <select name="" id="" class="bookingVals">
                            <option value="">7.00 AM</option>
                            <option value="">5.00 PM</option>   
                        </select><br><br>
                        <label for="" class="bookingLbls">Total Charge: </label>
                        <input type="number" class="bookingVals" id="totalCharge" value="0" style="width: 73%; background-color: #dddddd;" readonly><br><br>
                        <div class="bookingBtns">
                            <button id="bookingBtn1">Cancel Reservation</button>
                            <button id="bookingBtn2">Confirm Reservation</button>
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