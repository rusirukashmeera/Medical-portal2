<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - MEDPORTAL</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/faq.css">
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
                <li><a href="index.php">Home</a></li>
                <li><a href="our_services.php">Our Services</a></li>
                <li><a href="about_us.php">About Us</a></li>
                <li><a href="new_contact.php">Contact Us</a></li>
                <li><a href="#" class="active">FAQ</a></li>
            </ul>
            <!-- <button id="signupBtn">Sign Up</button> -->
        </div>
    </div>
    <div class="content" id="content">
        <div class="title-2">
            <center><h1>Frequently Asked Questions (FAQ)</h1><center>
        </div>
        <div class="faq-section">
        <button class="faq-question">What if I do not remember my username?</button>
        <div class="faq-answer">
            <p>You will have to call the Patient Portal Customer Service number at +94XXXXXXXX</p>
        </div>
    </div>

    <div class="faq-section">
        <button class="faq-question">What if I do not remember my password or my account is locked out?</button>
        <div class="faq-answer">
            <p>You are allowed 3 attempts to successfully log into the Patient Portal. After the third failed attempt, for your protection, your account will be locked out. You will need to call +94XXXXXXXX  to reset your password.</p>
        </div>
    </div>

    <div class="faq-section">
        <button class="faq-question">What if I notice something is not correct on the portal, such as allergy medication?</button>
        <div class="faq-answer">
            <p>You should make a note of this and discuss it with the physician or clinic staff member at your next visit.</p>
        </div>
    </div>

    <div class="faq-section">
        <button class="faq-question">Do you have additional questions?</button>
        <div class="faq-answer">
            <p>If you have additional questions, please call Patient Portal Support at  and they will assist you</p>
        </div>
    </div>
    </div>
    <footer class="footerX">
        <p>Lifeline Healthcare &copy; 2024. All rights reserved.</p>
    </footer>
    <script src="js/script.js"></script>
    <script src="js/home.js"></script>

    <script>
    // Select all FAQ question buttons and add click event listeners
    document.querySelectorAll('.faq-question').forEach(button => {
        button.addEventListener('click', () => {
            const answer = button.nextElementSibling;// Get the corresponding answer element

            button.classList.toggle('active');// Toggle active class for styling

            // Toggle the display of the answer
            if (answer.style.display === 'block') {
                answer.style.display = 'none';// Hide answer if currently visible

            } else {
                answer.style.display = 'block';// Show answer if currently hidden
            }
        });
    });
    </script>
</body>
</html>