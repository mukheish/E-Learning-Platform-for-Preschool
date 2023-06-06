<?php
// Assuming you have already established a database connection

$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "psms"; // Replace with your database name

// Create a connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$connection) {
  die("Connection failed: " . mysqli_connect_error());
}

// Query the database to retrieve questions and answers
$query = "SELECT q.question_id, q.question_text, a.answer_text, a.is_correct
          FROM questions AS q
          INNER JOIN answers AS a ON q.question_id = a.question_id";
$result = mysqli_query($connection, $query);

if (!$result) {
  die("Database query failed.");
}

// Retrieve the user name and score from the form submission
$userName = 'test';//$_POST['user_name']; // Assuming you have an input field with the name "user_name" in your form
$score = $_POST['score']; // Retrieve the score from the hidden input field
echo $score;
// Insert the result into the "results" table
$query = "INSERT INTO results (user_name, score, quiz_date)
          VALUES ('$userName', '$score', CURDATE())";
$result = mysqli_query($connection, $query);

if (!$result) {
  die("Database query failed.");
}

// Close the connection
mysqli_close($connection);
?>

