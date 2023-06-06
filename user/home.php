<?php 
require_once 'config.php';
include 'header.html'; 
$aid=$_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="login.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
  background-color: #f2f2f2; /* Set a background color */
  background-image: url("11.jpg"); /* Set a background image */
  background-repeat: no-repeat; /* Prevent the background image from repeating */
  background-size: cover; /* Scale the background image to cover the entire body */
}
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .card {
            background-color: #fff;
            border-radius: 4px;
            padding: 20px;
            margin-bottom: 20px;
        }

        h1 {
            text-align: center;
        }

        h2 {
            font-size: 24px;
            margin-top: 0;
        }

        p {
            margin-bottom: 10px;
        }

        .date-icon {
            color: #2980b9;
        }

        .description-icon {
            color: #27ae60;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>News and Events</h1>
    
    <?php
    // Retrieve news and events from the database
    // Perform database query and retrieve data
    $sql = "SELECT * FROM news_events ORDER BY event_date DESC";
    $result = mysqli_query($conn, $sql);

    // Display news and events
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $eventName = $row['event_name'];
            $eventDate = $row['event_date'];
            $eventDescription = $row['event_description'];

            // Display event details in a card-like format
            echo "<div class='card'>";
            echo "<h2>$eventName</h2>";
            echo "<p>Date: $eventDate</p>";
            echo "<p>$eventDescription</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No news or events found.</p>";
    }
    ?>
</div>
</body>
</html>