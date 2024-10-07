<?php
// Include the database configuration file
    include_once("config.php");
    
    // Start the session to access session variables
    session_start();
    $firstName = $_SESSION["firstName"];
    $lastName = $_SESSION["lastName"];
    $appID = $_SESSION["appID"];
    $docID = $_SESSION["docID"];
    $date = $_SESSION["date"];
    $time = $_SESSION["time"];
    // SQL query to retrieve the doctor's first and last names using the doctor's ID
    $sql_get_doc = "SELECT U.First_Name, U.Last_Name FROM user_table U, doctor D WHERE D.Doctor_Id = $docID AND D.Email = U.Email";
    $result_get_doc = mysqli_query($conn, $sql_get_doc);
   
    // Check if the query returned any rows and fetch the doctor's name
    if(mysqli_num_rows($result_get_doc) > 0){
        $row = mysqli_fetch_assoc($result_get_doc);
        $docFirstName = $row["First_Name"];
        $docLastName = $row["Last_Name"];
    }

     // Check if the "edit" button was clicked
    if(isset($_POST["edit"])){
        $date = $_POST["date"];
        $time = $_POST["time"];

         // SQL query to update the booking details
        $sql_update_booking = "UPDATE online_booking SET Date = '$date', Session_No = $time WHERE Booking_Id = $appID";
        
        // Execute the update query and provide feedback
        if(mysqli_query($conn, $sql_update_booking)){
            echo "<script>alert('Channeling with booking id $appID updated successfully!');
            setTimeout(function() {
                    window.location.href = 'channeling.php';
                }, 1);</script>";
        }
    }

    // Check if the "cancel" button has been clicked in the form submission
    if(isset($_POST["cancel"])){

         // Prepare the SQL query to delete the booking entry from the online_booking table
        $sql_delete_booking = "DELETE FROM online_booking WHERE Booking_Id = $appID";
        
        // Execute the delete query against the database connection
        if(mysqli_query($conn, $sql_delete_booking)){
           
           // Show a success alert if the deletion is successful
            echo "<script>alert('Channeling with booking id $appID deleted successfully!');
            setTimeout(function() {
                    window.location.href = 'channeling.php';
                }, 1);</script>";
        }
    }

    // Check if the "logout" button has been clicked in the form submission
    if(isset($_POST["logout"])){
        // Clear all session variables to log out the user
        session_unset();
        // Destroy the current session to completely log out the user
        session_destroy();
        // Close the database connection to free up resources
        mysqli_close($conn);
         // Redirect the user to the homepage after logging out
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEDPORTAL</title>

    <!-- links to the stylesheets -->
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
            <div class="profile"> <!-- User profile section -->
                <img class="avatar" src="images/avatar.png" alt="Generic Avatar">
                <div class="accInfo">
                    <label class="accName"><?php echo $firstName." ".$lastName ?></label><br>
                    <label class="accType">Patient</label>
                </div>
            </div>
        </header>
        <div class="navbar"><!-- Navigation bar -->
            <ul class="options">
                <li><a href="index.php">Home</a></li>
                <li><a href="our_services.php">Our Services</a></li>
                <li><a href="about_us.php">About Us</a></li>
                <li><a href="new_contact.php">Contact Us</a></li>
                <li><a href="faq.php">FAQ</a></li>
                <li><a href="#" class="active">Edit Channeling</a></li>
            </ul>
            <button id="signupBtn">Sign Out</button>
            <form id="logoutForm" method="POST" action="edit_channeling.php" style="display: none;">
                <input type="text" value="1" name="logout">
            </form>
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
                    <div class="channeling-details"><!-- Channeling details container -->
                        <h1>Channeling Details</h1>
                        <div style="outline-style: double; outline-width: 2px; outline-color: black;">
                            <form method="POST"><!-- Form for editing channeling details -->
                                <label for="Appointment-ID">Booking ID:</label>
                                <input class="details" type="text" id="Appointment-ID" value='<?php echo $appID ?>' disabled>
                                <label for="doctor">Doctor:</label>
                                <input class="details" type="text" id="doctor" name="doctor" value='<?php echo $docFirstName." ".$docLastName ?>' disabled>
                                <label for="Doctor-ID">Doctor ID:</label>
                                <input class="details" type="text" id="Doctor-ID" name="Doctor-ID" value='<?php echo $docID ?>' readonly>
                                <label for="date">Select Date:</label>
                                <input class="details" type="date" id="date" name="date" value='<?php echo $date ?>' disabled>
                                <label for="time-slot">Select from an Available Time Slot:</label>
                                <div class="time-slot-options"><!-- Container for time slot options -->
                                    <input type="radio" id="slot1" name="time" <?php if($time == 1){echo 'checked';} ?> value="1" disabled>
                                    <label for="slot1">7.00 AM</label>
                                    <input type="radio" id="slot2" name="time" <?php if($time == 2){echo 'checked';} ?> value="2" disabled>
                                    <label for="slot2">5.00 PM</label>
                                    <input type="radio" id="slot3" name="time" <?php if($time == 3){echo 'checked';} ?> value="3" disabled>
                                    <label for="slot3">8.00 PM</label>
                                </div>
                                <button class="edit" type="submit" name="edit">EDIT</button><!-- Button to submit the edit form -->
                                </form>
                            </form>
                            <form method="POST"><!-- Form for cancelling the appointment -->
                                <button class="cancel" type="submit" id="cancel" name="cancel">CANCEL</button><br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Footer section -->
    <footer class="footerX">
        <p>Lifeline Healthcare &copy; 2024. All rights reserved.</p>
    </footer>

    <script src="js/edit_channeling.js"></script><!-- Link to JavaScript for editing channeling -->
    <script src="js/signout.js"></script><!-- Link to JavaScript for sign-out functionality -->

</body>
</html>
