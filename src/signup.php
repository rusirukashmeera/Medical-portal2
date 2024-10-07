<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - MEDPORTAL</title>
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
                    <label class="accName"></label><br>
                    <label class="accType">Guest</label>
                </div>
            </div>
        </header>
        <div class="navbar" id="navbar">
            <ul class="options">
                <li><a href="#" class="active">Home</a></li>
                <li><a href="our_services.php">Our Services</a></li>
                <li><a href="about_us.php">About Us</a></li>
                <li><a href="new_contact.php">Contact Us</a></li>
                <li><a href="faq.php">FAQ</a></li>
            </ul>
            <!-- <a href="signup.php">
                <button id="signupBtn">Sign Up</button>
            </a> -->
        </div>
    </div>
    <div class="content" id="content">
        <div class="form-container">
            <form id="signupForm" action="signup_process.php" method="POST">
                <label for="firstName">First Name</label><br>
                <input type="text" id="firstName" name="first_name" placeholder="Value" required><br>

                <label for="secondName">Last Name</label><br>
                <input type="text" id="secondName" name="second_name" placeholder="Value" required><br>

                <label for="nic">NIC</label><br>
                <input type="text" id="nic" name="nic" placeholder="Value" required><br>

                <label for="address">Address</label><br>
                <input type="text" id="address" name="address" placeholder="Value" required><br>

                <label for="email">Email Address</label><br>
                <input type="email" id="email" name="email" placeholder="Value" required><br>

                <label for="phone">Phone Number</label><br>
                <input type="tel" id="phone" name="phone_number" placeholder="+111" required><br>
                
                <label for="gender">Gender</label>
                <select id="gender" name="gender" required>
                    <option value="">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select><br>

                <label for="dob">Date of Birth</label>
                <div class="dob-input">
                    <input type="text" id="day" name="dob_day" placeholder="DD" maxlength="2" required>
                    <input type="text" id="month" name="dob_month" placeholder="MM" maxlength="2" required>
                    <input type="text" id="year" name="dob_year" placeholder="YYYY" maxlength="4" required>
                </div><br>

                <label for="password">Create a Password</label><br>
                <input type="password" id="password" name="password" placeholder="Value" required><br>

                <label for="confirmPassword">Confirm Password</label><br>
                <input type="password" id="confirmPassword" name="confirm_password" placeholder="Value" required><br>

                <button type="submit" class="signupBtn">Sign Up</button>
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