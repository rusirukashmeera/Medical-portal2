<?php
    include_once("config.php"); // establish the database connection

    session_start(); // start the session

    $firstName = $_SESSION["firstName"];
    $lastName = $_SESSION["lastName"]; // retrieving some user data from session variables

    // sql query to get appointment details
    $sql_get_apps = "SELECT C.Appointment_Id, C.First_Name AS Pat_Name, C.Age, C.Gender, U.First_Name AS Doc_Name, C.Date, C.Session_No, C.Charge
    FROM confirm_booking C, doctor D, user_table U WHERE C.Doctor_Id = D.Doctor_Id AND D.Email = U.Email ORDER BY C.Appointment_Id";
    
    $result_get_apps = mysqli_query($conn, $sql_get_apps); // storing the result after executing the sql query

    if(isset($_GET["appID"])){
        $delID = $_GET["appID"]; // appointment id to delete
        $sql_delete = "DELETE FROM confirm_booking WHERE Appointment_Id = $delID"; // sql query to delete a record from confirm_booking table

        if(mysqli_query($conn, $sql_delete)){
            echo "<script>alert('Appointment deleted successfully!');
                setTimeout(function() {
                    window.location.href = 'manage_appointments.php';
                }, 1);</script>";
        } //redirect to appointment table if record was deleted succesfully (with a success message)
        // header("Location: manage_appointments.php");
    }
?>