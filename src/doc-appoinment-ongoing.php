<?php
include_once ("config.php");
session_start();// Start the session

//retreve data from the session 
$firstName = $_SESSION["firstName"];
$lastName = $_SESSION["lastName"];

/*variables for showing user name and type*/
$_SESSION["patID"] = "";
$_SESSION["patName"] = "";
$_SESSION["age"] = "";
$_SESSION["gender"] = "";
$_SESSION["presc"] = "";
$checkApp = 0;

if(isset($_POST["search"])){//checks serch button is clicked or not
    $appID = $_POST["appID"];
    $_SESSION["appID"] = $appID;
    //retrive datafrom the submitted form

    if(!empty($appID)){// Check if the application ID is not empty
        $_SESSION["check"] = 0;
        // SQL query to get patient details based on the appointment ID
        $sql_get_patient = "SELECT Patient_Id, First_Name, Age, Gender FROM confirm_booking WHERE Appointment_Id = $appID";
        $result_get_patient = mysqli_query($conn, $sql_get_patient);// Execute the query
        if(mysqli_num_rows($result_get_patient) > 0){// Check if any patient records are found
            $checkApp = 1;
            $row = mysqli_fetch_assoc($result_get_patient);
            $_SESSION["patID"] = $row["Patient_Id"];
            $_SESSION["patName"] = $row["First_Name"];
            $_SESSION["age"] = $row["Age"];
            $_SESSION["gender"] = $row["Gender"];
        }// Check if any patient records are found and store patient details in session variables
        
        // Prepare a SQL query to fetch medicines prescribed for the given appointment ID and initialize the session variable for prescriptions
        $sql_get_presc = "SELECT Medicine FROM prescription WHERE Appointment_Id = ".$_SESSION["appID"];
        $result_get_presc = mysqli_query($conn, $sql_get_presc);
        $_SESSION["presc"] = "";

        if(mysqli_num_rows($result_get_presc) > 0){
            $_SESSION["check"] = 1;
            $row2 = mysqli_fetch_assoc($result_get_presc);
            $_SESSION["presc"] = $row2["Medicine"];
        }// Check if any prescriptions are found; if so, set the session variable for prescription status and store the first prescribed medicine
    }
}//store relevent data in the session variables


if(isset($_POST["save"]) && ($_SESSION["check"] == 0)){// Check if the save button is clicked and the availability of patient records
    $appID = $_SESSION["appID"];
    $presc = $_POST["prescription-details"];
    $sql_create_presc = "INSERT INTO prescription (Appointment_Id, Medicine) VALUES ($appID, '$presc')";//Store the prescription details in the database

    //reset patient session variables
    $_SESSION["patID"] = "";
    $_SESSION["patName"] = "";
    $_SESSION["age"] = "";
    $_SESSION["gender"] = "";
    if(mysqli_query($conn, $sql_create_presc)){
        echo "<script>alert('Prescription saved successfully!');</script>";
    }// Execute the prescription insertion query and display a success message if the operation is successful
}
else if(isset($_POST["save"]) && ($_SESSION["check"] == 1)){// Check if the save button is pressed and prescriptions have been found in the session
    $appID = $_SESSION["appID"];
    $presc = $_POST["prescription-details"];
    $sql_update_presc = "UPDATE prescription SET Medicine = '$presc' WHERE Appointment_Id = $appID";// Prepare an SQL query to update the prescription details

    //reset patient session variables
    $_SESSION["patID"] = "";
    $_SESSION["patName"] = "";
    $_SESSION["age"] = "";
    $_SESSION["gender"] = "";
    if(mysqli_query($conn, $sql_update_presc)){
        echo "<script>alert('Prescription updated successfully!');</script>";
    }// Execute the prescription update query and display a success message if the operation is successful

}//save or edit prescription 

if(isset($_POST["delete"])){// Check if the delete button has been pressed
    $appID = $_SESSION["appID"];
    $sql_delete_presc = "DELETE FROM prescription WHERE Appointment_Id = $appID";// Prepare an SQL query to delete the prescription 

    //reset patient session variables
    $_SESSION["patID"] = "";
    $_SESSION["patName"] = "";
    $_SESSION["age"] = "";
    $_SESSION["gender"] = "";
    if(mysqli_query($conn, $sql_delete_presc)){
        echo "<script>alert('Prescription deleted successfully!');</script>";
    }// Execute the prescription delete query and display a success message if the operation is successful

}// Check if the delete button is pressed; if so, delete the prescription

if(isset($_POST["logout"])){
    session_unset();
    session_destroy();
    mysqli_close($conn);
    header("Location: index.php");
}// logout function 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ongoing Session</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/doc-appoinment-ongoing.css">
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
                    <label class="accName"><?php echo $firstName." ".$lastName ?></label><br><!--display the user name-->
                    <label class="accType">Doctor</label>
                </div>
            </div>
        </header>   
        <div class="navbar">
            <ul class="options">
                <li><a href="doc-schedule.php">Schedule</a></li>
                <li><a href="#" class="active">Session</a></li>
            </ul>
            <button id="signupBtn">Sign Out</button>
            <form id="logoutForm" method="POST" action="#" style="display: none;">
                <input type="text" value="1" name="logout">
            </form>
        </div>
    </div>
    <div class="content">
        <div class="ongoing-box">
            <div class="session">
                <div class="session-details">
                    <form action="doc-appoinment-ongoing.php" method="POST" class="date-time">
                        <label for="ID">Appoinment ID:</label> 
                        <input type="text" id="appID" name="appID"><br><br>

                        <fieldset><!--show patient details-->
                            <legend>Patient Details:</legend>
                            <input type="text" value="Patient ID:" class="input-hide" readonly>  <input type="text" value='<?php echo $_SESSION["patID"]; ?>' class="input-hide" name="patID" readonly><br><br>
                            <input type="text" value="Name:" class="input-hide" readonly>  <input type="text" value='<?php echo $_SESSION["patName"]; ?>' class="input-hide" name="patName" readonly><br><br>
                            <input type="text" value="Age:" class="input-hide" readonly>  <input type="number" value='<?php echo $_SESSION["age"]; ?>' class="input-hide" name="age" readonly><br><br>
                            <input type="text" value="Gender:" class="input-hide" readonly>  <input type="text" value='<?php echo $_SESSION["gender"]; ?>' class="input-hide" name="gender" readonly><br><br>
                        </fieldset>

                        <input type="submit" id="submit" value="Search" name="search">
                    </form>
                </div>

                <div class="prescription">
                    <form action="doc-appoinment-ongoing.php" method="POST">
                        <fieldset>
                            <legend>Prescription:</legend>
                            <textarea id="prescription-details" name="prescription-details"><?php echo $_SESSION["presc"]; ?></textarea><br><br>
                        </fieldset>
                        
                        <!--Display the "Save" button if a patient record is found and the "Delete" button if a prescription exists in the session-->
                        <?php if($checkApp == 1){echo "<button type=\"submit\" id=\"save\" name=\"save\">Save</button>";}?>
                        <?php if(!empty($_SESSION["presc"])){echo "<button id=\"delete\" name=\"delete\">Delete</button>";}?>
                        
                    </form>
                </div>
            </div>

            
            
        </div>
    </div>
    <footer class="footerX">
        <p>Lifeline Healthcare &copy; 2024. All rights reserved.</p>
    </footer>

    <script src="../src/js/doc-appoinment-ongoing.js"></script>
    <script src="js/signout.js"></script>
</body>
</html>