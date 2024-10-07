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
        <button class="faq-question">What is your return policy?</button>
        <div class="faq-answer">
            <p>Our return policy allows you to return items within 30 days of purchase. Items must be unused and in their original packaging.</p>
        </div>
    </div>

    <div class="faq-section">
        <button class="faq-question">How long does shipping take?</button>
        <div class="faq-answer">
            <p>Shipping usually takes between 5-7 business days depending on your location. Expedited shipping options are available at checkout.</p>
        </div>
    </div>  

    <div class="faq-section">
        <button class="faq-question">Do you ship internationally?</button>
        <div class="faq-answer">
            <p>Yes, we offer international shipping to most countries. Additional shipping charges may apply.</p>
        </div>
    </div>

    <div class="faq-section">
        <button class="faq-question">How can I track my order?</button>
        <div class="faq-answer">
            <p>Once your order is shipped, we will send you a tracking number via email, which you can use to track your order on our website.</p>
        </div>
    </div>
    </div>
    <footer class="footerX">
        <p>Lifeline Healthcare &copy; 2024. All rights reserved.</p>
    </footer>
    <script src="js/script.js"></script>
    <script src="js/home.js"></script>

    <script>
    document.querySelectorAll('.faq-question').forEach(button => {
        button.addEventListener('click', () => {
            const answer = button.nextElementSibling;

            button.classList.toggle('active');

            if (answer.style.display === 'block') {
                answer.style.display = 'none';
            } else {
                answer.style.display = 'block';
            }
        });
    });
    </script>
</body>
</html>