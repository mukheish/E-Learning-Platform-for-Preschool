<?php
include 'config.php';
    // Form submission handling
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $eventName = $_POST['event_name'];
        $eventDate = $_POST['event_date'];
        $eventDescription = $_POST['event_description'];

        // Perform database insert
        $sql = "INSERT INTO news_events (event_name, event_date, event_description) 
                VALUES ('$eventName', '$eventDate', '$eventDescription')";
        mysqli_query($conn, $sql);

        // Redirect to the news.php page after successful submission
        header("Location: home.php");
        exit;
    }
    
?>