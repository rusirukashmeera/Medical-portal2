<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conformed Appoinment</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/doc-schedule.css">
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
                    <label class="accName">doc_name</label><br>
                    <label class="accType">Doctor</label>
                </div>
            </div>
        </header>
        <div class="navbar">
            <ul class="options">
                <li><a href="#"  class="active">Schedule</a></li>
                <li><a href="doc-appoinment-ongoing.php" >Session</a></li>
            </ul>
            <button id="signupBtn">Log Out</button>
        </div>
    </div>
    <div class="content">
        <div class="schedule-date-time">
            <form action="" class="date-time" id="date-time" method="POST">

                <div class="date">
                    <label for="date">Date:</label><br>
                    <input type="date" id="date" name="date" required><br><br>
                </div>

                <div class="time">
                    <label for="time">Select the Session:</label><br><br>
                    <input type="radio" id="time" name="session" >Session 1<br><br>
                    <input type="radio" id="time" name="session" >Session 2<br><br>
                    <input type="radio" id="time" name="session" >Session 3<br><br>
                </div>

                <button class="submit" id="submit" type="submit">Search</button>
            </form>

            
            
        </div>

        <table id="schedule-table">
    <tr>
        <th>AppoinmentID</th>
        <th>Patient Name</th>
        <th>Date</th>
    </tr>

    <?php

    include_once("config.php");
    
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['date'])) {
        $date = $_POST['date'];
    
        // Fetch data from confirm_booking table
        $sql = "SELECT Appointment_Id, First_name, Date FROM confirm_booking WHERE Date = '$date'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["Appointment_Id"] . "</td>";
                echo "<td>" . $row["First_name"] . "</td>";
                echo "<td>" . $row["Date"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No bookings found</td></tr>";
        }
    }
    $conn->close();
    ?>
</table>

        <a href="doc-appoinment-ongoing.php" target="_blank"><button id="start-session">Start Session</button></a>

    </div>
    <footer class="footerX">
        <p>Lifeline Healthcare &copy; 2024. All rights reserved.</p>
    </footer>

    <script src="../src/js/doc-schedule.js"></script>
</body>
</html>