<?php
    include_once("config.php");
    session_start();
    $loginCheck = null;  //variable to store login status
    if(isset($_POST["signinHome"])){
        if(!empty($_POST["email"]) && !empty($_POST["password"])){
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["password"] = $_POST["password"];
            $sql = "SELECT * FROM user_table WHERE Email = '".$_SESSION["email"]."' AND Password = '".$_SESSION["password"]."'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                $loginCheck = 1;  //indicate user logged in
                $row = mysqli_fetch_assoc($result);
                $_SESSION["firstName"] = $row["First_Name"];
                $_SESSION["lastName"] = $row["Last_Name"];
                $_SESSION["accType"] = $row["Account_Type"];
                switch($row["Account_Type"]){
                    case "Receptionist": header("Location: manage_appointments.php");
                    break;
                    case "Doctor": header("Location: doc-schedule.php");
                    break;
                    case "Patient": header("Location: channeling.php");
                    break;
                }
            }
            else{
                $loginCheck = 0;  //indicate user not logged in
            }
        }
    }
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEDPORTAL</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/home.css">
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
                    <label class="accName"></label><br>
                    <label class="accType">Guest</label>
                </div>
            </div>
        </header>
        <div class="navbar" id="navbar">
            <ul class="options">
                <li><a href="#" class="active">Home</a></li>
                <li><a href="#">Our Services</a></li>
                <li><a href="about_us.php">About Us</a></li>
                <li><a href="new_contact.php">Contact Us</a></li>
                <li><a href="#">FAQ</a></li>
            </ul>
            <button id="signupBtn">Sign Up</button>
            <form id="signupForm" method="POST" action="signup.php" style="display: none;">
                <input type="text" value="1" name="signup">
            </form>
        </div>
    </div>
    <div class="content" id="content">
        <div class="signin">
            <form id="signinForm" action="index.php" method="POST">
                <label class="signinLbls" for="">Username</label><br>
                <input class="signinVals" type="email" name="email" id="email" required><br><br>
                <label class="signinLbls" for="">Password</label><br>
                <input class="signinVals" type="password" name="password" id="password" required><br><br><br>
                <button id="signinHome" name="signinHome">Sign In</button>
                <label for="" class="signinLbls" id="check" style="color: #ff0000;"><?php
                    if(isset($_POST["signinHome"]) && $loginCheck == 0){
                        echo "<br><br>Incorrect Username or Password";
                    }
                ?></label>
            </form>
        </div>
    </div>
    <footer class="footerX">
        <p>Lifeline Healthcare &copy; 2024. All rights reserved.</p>
    </footer>
    <script src="js/script.js"></script>
    <script src="js/home.js"></script>
</body>
</html>