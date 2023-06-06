<?php
// Include the database connection and config file
include 'config.php';
// Assuming you have already established a database connection

// Retrieve form data
$foodName = $_POST['food_name'];
$userId = $_SESSION['user_id'];
$mathMarks = $_POST['subject_math'];
$comment = $_POST['comment'];

$query = "SELECT * FROM users WHERE ID = $userId";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 1) {
    // User credentials are valid, fetch the user record
    $user = mysqli_fetch_assoc($result);
  
    // Store the user ID in the session
    $studentName = $user['student_name'];
  
  }
  else{
    echo "invalid student ID";
  }
// Insert marks into the database
$sql = "INSERT INTO food_allergy (student_name, food_name, Ingredient, comment) VALUES ('$studentName', '$foodName', '$mathMarks', '$comment')";

if (mysqli_query($conn, $sql)) {
  echo "Marks added successfully.";
} else {
  echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);

// Redirect to a success page or perform other actions as needed
header("Location: view_food.php");
exit();
?>
