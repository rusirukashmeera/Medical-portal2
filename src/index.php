<?php
    session_start();
    $loginCheck = 0;
    if(isset($_POST["signinHome"])){
        if(!empty($_POST["email"]) && !empty($_POST["password"])){
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["password"] = $_POST["password"];
            $loginCheck = 1;
            header("Location: receptionist_offline.php");
        }
    }
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
                    <h3 style="font-size: 25px; margin-bottom: 5px; color: #ffffff;">Lifeline Healthcare</h3>
                    <h1 style="font-size: 40px; margin-top: 0; color: #ffffff;">MEDPORTAL</h1>
                </div>
            </div>
            <div class="profile">
                <img class="avatar" src="images/avatar.png" alt="Generic Avatar">
                <div class="accInfo">
                    <label class="accName">fegegwfew</label><br>
                    <label class="accType">Administrator</label>
                </div>
            </div>
        </header>
        <div class="navbar" id="navbar">
            <ul class="options">
                <li><a href="#" class="active">Home</a></li>
                <li><a href="#">Our Services</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">FAQ</a></li>
            </ul>
            <button class="signupBtn">Sign Up</button>
        </div>
    </div>
    <div class="content" id="content">
        <div class="signin">
            <form id="signinForm" action="index.php" method="POST">
                <label class="signinLbls" for="">Username</label><br>
                <input class="signinVals" type="email" name="email" id="email"><br><br>
                <label class="signinLbls" for="">Password</label><br>
                <input class="signinVals" type="password" name="password" id="password"><br><br><br>
                <button id="signinHome" name="signinHome">Sign In</button>
                <label for="" class="signinLbls" id="check"></label>
            </form>
        </div>
    </div>
    <footer class="footerX">
        <p>Lifeline Healthcare &copy; 2024. All rights reserved.</p>
    </footer>
    <script src="js/script.js"></script>
</body>
</html>