<?php
// Include the database connection and config file
include 'config.php';
// Assuming you have already established a database connection

// Retrieve form data
$studentName = $_POST['options'];
$mathMarks = $_POST['subject_math'];
$scienceMarks = $_POST['subject_science'];
$englishMarks = $_POST['subject_english'];


// Insert marks into the database
$sql = "INSERT INTO report_card (student_name, math_marks, science_marks, english_marks) VALUES ('$studentName', $mathMarks, $scienceMarks, $englishMarks)";

if (mysqli_query($conn, $sql)) {
  echo "Marks added successfully.";
} else {
  echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);

// Redirect to a success page or perform other actions as needed
header("Location: report.php");
exit();
?>
