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
  $firstName = $_POST["first-name"];
  $lastName = $_POST["last-name"];
  $studentName = $_POST["student-name"];
  $studentAge = $_POST["student-age"];
  $address = $_POST["address"];
  
  // Validate and sanitize the data (you can add your own validation logic here)
  $username = mysqli_real_escape_string($conn, $username);
  $email = mysqli_real_escape_string($conn, $email);
  $password = mysqli_real_escape_string($conn, $password);
  $firstName = mysqli_real_escape_string($conn, $firstName);
  $lastName = mysqli_real_escape_string($conn, $lastName);
  $studentName = mysqli_real_escape_string($conn, $studentName);
  $studentAge = mysqli_real_escape_string($conn, $studentAge);
  $address = mysqli_real_escape_string($conn, $address);
  
  // Hash the password
  //$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  
  // Insert data into the database
  $sql = "INSERT INTO users (username, email, password, parent_Fname, parent_Lname, student_name, student_age, address) 
          VALUES ('$username', '$email', '$password', '$firstName', '$lastName', '$studentName', '$studentAge', '$address')";
  
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
