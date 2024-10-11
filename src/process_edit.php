<?php
    include_once("config.php");
    session_start();
    if(isset($_GET["bookingBtn3"])){
        $e_appID = $_SESSION["appID"];
        $e_patName = $_GET["patName"];
        $e_patAge = $_GET["patAge"];
        $e_gender = $_GET["gender"];
        $e_docID = $_GET["docID"];
        $e_dateX = $_GET["dateX"];
        $e_timeX = $_GET["timeX"];
        $e_charge = $_GET["totalCharge"]; // storing GET values in local variables

        // sql query to update a record in confirm_booking table
        $sql_update_app = "UPDATE confirm_booking SET First_Name = '$e_patName', Age = $e_patAge, Gender = '$e_gender', Doctor_ID = $e_docID, 
        Date = '$e_dateX', Session_No = $e_timeX, Charge = $e_charge WHERE Appointment_Id = $e_appID";
        
        //header("Location: manage_appointments.php");

        if(mysqli_query($conn, $sql_update_app)){
            echo "<script>alert('Appointment edited successfully!');
            setTimeout(function() {
                    window.location.href = 'manage_appointments.php';
                }, 1);</script>";
        } //redirect to appointment table if record was updated succesfully (with a success message)
    }
    // if(isset($_POST["logout"])){
    //     session_unset();
    //     session_destroy();
    //     mysqli_close($conn);
    //     header("Location: index.php");
    // }
?>