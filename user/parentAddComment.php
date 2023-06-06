<?php
// Include the database connection and config file
include 'config.php';
// Assuming you have already established a database connection

// Retrieve form data
$parentComment = $_POST['parentComment'];
$reportId = $_POST['reportId'];


// Insert marks into the database
$sql ="UPDATE report_card SET parent_comments = '$parentComment' WHERE id = $reportId";


if (mysqli_query($conn, $sql)) {
  echo "Marks added successfully.";
} else {
  echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);

// Redirect to a success page or perform other actions as needed
header("Location: view_report.php");
exit();
?>