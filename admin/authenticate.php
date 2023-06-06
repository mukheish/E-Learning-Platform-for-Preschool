<?php
// authenticate.php

// Start the session
session_start();
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "psms"; // Replace with your database name

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
} 

// Retrieve the submitted username and password
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare the query to retrieve user credentials
$query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
  // User credentials are valid, fetch the user record
  $user = mysqli_fetch_assoc($result);

  // Store the user ID in the session
  $_SESSION['user_id'] = $user['ID'];

  // Redirect to the dashboard or desired webpage
  header('Location: home.php');
  exit();
} else {
  // Invalid credentials, redirect back to the login page with an error message
  header('Location: login.php?error=1');
  exit();
}
?>
