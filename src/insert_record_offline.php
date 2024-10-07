<?php
    include_once("config.php"); //establish the database connection

    if(isset($_GET["bookingBtn2"])){
        $patName = $_GET["patName"];
        $patAge = $_GET["patAge"];
        $gender = $_GET["gender"];
        $docID = $_GET["docID"];
        $dateX = $_GET["dateX"];
        $timeX = $_GET["timeX"];
        $totalCharge = $_GET["totalCharge"]; // retrieving some user data from session variables

        //sql query to create a record in confirm_booking table
        $sql_insert_offline = "INSERT INTO confirm_booking (First_Name, Age, Gender, Doctor_ID, Date, Session_No, Type, Charge) 
        VALUES ('$patName', $patAge, '$gender', $docID, '$dateX', $timeX, 'Offline', $totalCharge)";

        if(mysqli_query($conn, $sql_insert_offline)){
            echo "<script>alert('Appointment created successfully!');
            setTimeout(function() {
                    window.location.href = 'manage_appointments.php';
                }, 1);</script>";
        } //redirect to appointment table if record was inserted succesfully (with a success message)

        //header("Location: manage_appointments.php"); //redirect to appointments table
    }
    //mysqli_close($conn);
?>