<?php
// dashboard.php

// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
  $userId = $_SESSION['user_id'];

  // Display the user ID on the dashboard
  echo 'Welcome, User ID: ' . $userId;
} else {
  // Redirect the user back to the login page if not logged in
  header('Location: /PSMS/login.html');
  exit();
}
?>
