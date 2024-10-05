<?php
// db.php - Database connection
$servername = "localhost";  // Your database server
$username = "root";         // Your MySQL username
$password = "";             // Your MySQL password
$dbname = "medportaldb";      // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST['patient_id'];
    $patient_name = $_POST['patient_name'];
    $prescription_details = $_POST['prescription-details'];

    // Insert into the schedule table
    $sql = "INSERT INTO schedule (patient_id, patient_name, prescription_details) VALUES ('$patient_id', '$patient_name', '$prescription_details')";

    if ($conn->query($sql) === TRUE) {
        echo "New schedule record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>