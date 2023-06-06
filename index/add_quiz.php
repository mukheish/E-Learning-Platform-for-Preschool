<!DOCTYPE html>


<html>
<head>
  <title>Quiz</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 20px;
    }

    h1 {
      text-align: center;
    }

    #quizForm {
      background-color: #fff;
      border-radius: 5px;
      padding: 20px;
      max-width: 500px;
      margin: 0 auto;
    }

    h2 {
      margin-top: 20px;
    }

    p {
      margin-bottom: 10px;
    }

    input[type="radio"] {
      margin-bottom: 10px;
    }

    input[type="submit"] {
      display: block;
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .result {
      text-align: center;
      margin-top: 20px;
      font-weight: bold;
    }
  </style>
</head>
<body>
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


</body>
</html>


