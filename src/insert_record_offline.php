<?php
    include_once("config.php");
    if(isset($_GET["bookingBtn2"])){
        $patName = $_GET["patName"];
        $patAge = $_GET["patAge"];
        $gender = $_GET["gender"];
        $docID = $_GET["docID"];
        $dateX = $_GET["dateX"];
        $timeX = $_GET["timeX"];
        $totalCharge = $_GET["totalCharge"];
        $sql_insert_offline = "INSERT INTO confirm_booking (First_Name, Age, Gender, Doctor_ID, Date, Session_No, Type, Charge) 
        VALUES ('$patName', $patAge, '$gender', $docID, '$dateX', $timeX, 'Offline', $totalCharge)";
        mysqli_query($conn, $sql_insert_offline);
        header("Location: manage_appointments.php");
    }
?>