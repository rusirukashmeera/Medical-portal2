<?php
     // Include the database configuration file to establish a database connection
    include_once("config.php");
    // Start a new session or resume the existing one to access session variables
    session_start();

    // Retrieve user details from the session variables
    $firstName = $_SESSION["firstName"];
    $lastName = $_SESSION["lastName"];
    $email = $_SESSION["email"];

    // SQL query to fetch the user's NIC, address, contact number, gender, and date of birth from the database
    $sql = "SELECT U.NIC, P.Address, U.Contact_No, P.Gender, P.DOB FROM user_table U, patient P WHERE U.Email = '$email' AND P.Email = '$email'";
   
    // Execute the SQL query and store the result
    $result = mysqli_query($conn, $sql);

    // Check if any rows were returned from the query
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $nic = $row["NIC"];
        $address = $row["Address"];
        $contactNo = $row["Contact_No"];
        $gender = $row["Gender"];
        $dob = $row["DOB"];
    }


    // Check if the "edit" form was submitted
    if(isset($_POST["edit"])){
        // Get updated user details from the POST request
        $firstName = $_POST["first_name"];
        $lastName = $_POST["second_name"];
        $nic = $_POST["nic"];
        $address = $_POST["address"];
        $contactNo = $_POST["phone_number"];
        $gender = $_POST["gender"];
        $dob = $_POST["dob"];

        // SQL query to update the user details in the user_table
        $sql_edit = "UPDATE user_table SET NIC = '$nic', First_Name = '$firstName', Last_Name = '$lastName', Contact_No = '$contactNo' WHERE Email = '$email';";
        // SQL query to update the patient's details in the patient table
        $sql_edit2 = "UPDATE patient SET DOB = '$dob', Gender = '$gender', Address = '$address' WHERE Email = '$email';";
       
         // Execute both update queries
        if(mysqli_query($conn, $sql_edit) && mysqli_query($conn, $sql_edit2)){
           
             // Clear the session variables and destroy the session
            session_unset();
            session_destroy();

             // Display a success alert and redirect to the home page
            echo "<script>alert('Profile updated successfully!');
                setTimeout(function() {
                    window.location.href = 'index.php';
                }, 1);</script>";
        }
    }

      // Check if the "delete" form was submitted
    if(isset($_POST["delete"])){

         // SQL queries to delete the user and patient records from the database
        $sql_delete = "DELETE FROM user_table WHERE Email = '$email'";
        $sql_delete2 = "DELETE FROM patient WHERE Email = '$email'";
        
        // Execute both delete queries
        if(mysqli_query($conn, $sql_delete) && mysqli_query($conn, $sql_delete2)){
            // Clear the session variables and destroy the session
            session_unset();
            session_destroy();

            // Display a success alert and redirect to the home page
            echo "<script>alert('Profile deleted successfully!');
                setTimeout(function() {
                        window.location.href = 'index.php';
                    }, 1);</script>";
        }
    }

     // Check if the "logout" form was submitted
    if(isset($_POST["logout"])){
        session_unset();
        session_destroy();
        mysqli_close($conn);
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - MEDPORTAL</title>

     <!-- Link to CSS styles -->
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/signup.css">
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
                    <label class="accName"><?php echo $firstName." ".$lastName; ?></label><br>
                    <label class="accType">Guest</label>
                </div>
            </div>
        </header>
        <div class="navbar" id="navbar">
            <ul class="options">
                 <!-- Navigation links -->
                <li><a href="#" class="active">Home</a></li>
                <li><a href="our_services.php">Our Services</a></li>
                <li><a href="about_us.php">About Us</a></li>
                <li><a href="new_contact.php">Contact Us</a></li>
                <li><a href="faq.php">FAQ</a></li>
            </ul>

            <!-- Sign out button -->
            <button id="signupBtn">Sign Out</button>
            <form id="logoutForm" method="POST" action="edit_profile.php" style="display: none;">
                <input type="text" value="1" name="logout">
            </form>
        </div>
    </div>
    <div class="content" id="content">
        <div class="form-container">
            <form id="signupForm" action="#" method="POST">
            
             <!-- Form for editing user details -->
            <label for="firstName">First Name</label><br>
                <input type="text" id="firstName" name="first_name" value='<?php echo $firstName; ?>' required><br>

                <label for="secondName">Last Name</label><br>
                <input type="text" id="secondName" name="second_name" value='<?php echo $lastName; ?>' required><br>

                <label for="nic">NIC</label><br>
                <input type="text" id="nic" name="nic" value='<?php echo $nic; ?>' required><br>

                <label for="address">Address</label><br>
                <input type="text" id="address" name="address" value='<?php echo $address; ?>' required><br>

                <label for="phone">Phone Number</label><br>
                <input type="tel" id="phone" name="phone_number" value='<?php echo $contactNo; ?>' required><br>

                <label for="gender">Gender</label>
                <select id="gender" name="gender" required>
                    <option value="">Select</option>
                    <option value="Male" <?php if($gender == 'Male'){echo 'selected';} ?> >Male</option>
                    <option value="Female" <?php if($gender == 'Female'){echo 'selected';} ?> >Female</option>
                </select><br>

                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" value='<?php echo $dob; ?>' required><br><br>

                <!-- Buttons for editing or deleting the account -->
                <button type="submit" class="signupBtn" id="edit" name="edit">Edit Account</button><br><br>
                <button type="submit" class="signupBtn" id="delete" name="delete">Delete Account</button>
            </form>
        </div>
    </div>
    <footer class="footerX">
        <p>Lifeline Healthcare &copy; 2024. All rights reserved.</p>
    </footer>

    <!-- Links to JavaScript files -->
    <script src="js/script.js"></script>
    <script src="js/home.js"></script>
    <script src="js/signout.js"></script>
</body>
</html>