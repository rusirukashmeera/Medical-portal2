<?php
require_once 'config.php';

// Function to sanitize input data
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Initialize an errors array to hold validation errors 
//can be removed. 
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = isset($_POST['first_name']) ? sanitize_input($_POST['first_name']) : '';
    $second_name = isset($_POST['second_name']) ? sanitize_input($_POST['second_name']) : '';
    $username = isset($_POST['username']) ? sanitize_input($_POST['username']) : '';
    $email = isset($_POST['email']) ? filter_var(sanitize_input($_POST['email']), FILTER_VALIDATE_EMAIL) : '';
    $phone_number = isset($_POST['phone_number']) ? sanitize_input($_POST['phone_number']) : '';
    $gender = isset($_POST['gender']) ? sanitize_input($_POST['gender']) : '';
    $nic = isset($_POST['nic']) ? sanitize_input($_POST['nic']) : '';
    $address = isset($_POST['address']) ? sanitize_input($_POST['address']) : '';

    $dob_day = isset($_POST['dob_day']) ? intval($_POST['dob_day']) : 0;
    $dob_month = isset($_POST['dob_month']) ? intval($_POST['dob_month']) : 0;
    $dob_year = isset($_POST['dob_year']) ? intval($_POST['dob_year']) : 0;

    $password = isset($_POST['password']) ? sanitize_input($_POST['password']) : '';
    $confirm_password = isset($_POST['confirm_password']) ? sanitize_input($_POST['confirm_password']) : '';

    $accType = "Patient";

    // Validate Date of Birth
    if (!checkdate($dob_month, $dob_day, $dob_year)) {
        $errors[] = "Invalid date of birth.";
    } else {
        $date_of_birth = "$dob_year-$dob_month-$dob_day"; // Store as 'YYYY-MM-DD'
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    if (strlen($password) < 4) {
        $errors[] = "Password must be at least 4 characters long.";
    }

    if (empty($errors)) {
        // Insert user data into the database
        $sql = "INSERT INTO user_table (First_Name, Last_Name, Email, Contact_No, Password, NIC, Account_Type) 
                VALUES (?, ?, ?, ?, ?, ?, ?)"; 

        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters to the SQL query
            $stmt->bind_param("sssssss", $first_name, $second_name, $email, $phone_number, $password, $nic, $accType);

            if ($stmt->execute()) {
                // header("Location: index.php");
                echo "<script>alert('Profile created successfully!');
                setTimeout(function() {
                    window.location.href = 'index.php';
                }, 1);</script>";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error preparing SQL statement.";
        }
    } else {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
    $sql2 = "INSERT INTO patient (DOB, Gender, Address, Email) VALUES ('$date_of_birth', '$gender', '$address', '$email')";
    mysqli_query($conn, $sql2);
}
$conn->close();
?>
