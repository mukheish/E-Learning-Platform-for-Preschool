<?php
// Include the database connection and config file
include 'config.php';
// Assuming you have already established a database connection

// Retrieve form data
$studentName = $_POST['student_name'];
$mathMarks = $_POST['subject_math'];


// Insert marks into the database
$sql = "INSERT INTO food (food_name, food_content) VALUES ('$studentName', '$mathMarks')";

if (mysqli_query($conn, $sql)) {
  echo "Marks added successfully.";
} else {
  echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);

// Redirect to a success page or perform other actions as needed
header("Location: food.php");
exit();
?>
