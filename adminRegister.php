<?php
// Assuming you have already established a database connection
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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Retrieve form data
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  
  // Validate and sanitize the data (you can add your own validation logic here)
  $username = mysqli_real_escape_string($conn, $username);
  $email = mysqli_real_escape_string($conn, $email);
  $password = mysqli_real_escape_string($conn, $password);
  
  // Hash the password
  //$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  
  // Insert data into the database
  $sql = "INSERT INTO admin (username, email, password) VALUES ('$username', '$email', '$password')";
  
  if (mysqli_query($conn, $sql)) {
    // Registration successful
    echo "Registration successful!";
    // Redirect to a success page or perform any other desired action
    header("Location: login.html");
    exit();
  } else {
    // Registration failed
    echo "Error: " . mysqli_error($conn);
  }
}
?>