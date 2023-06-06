<?php
// Include the database connection and config file
include 'config.php';

// Check if quiz ID is provided
if (isset($_GET['food_id'])) {
  $quizId = $_GET['food_id'];


  // Delete the quiz from the database
  $sqlDeleteQuiz = "DELETE FROM quizzes WHERE quiz_id = $quizId";
  $result = mysqli_query($conn, $sqlDeleteQuiz);

  // Check if the delete query was successful
  if ($result) {
    echo "Quiz and associated questions have been deleted successfully.";
  } else {
    echo "Error deleting quiz: " . mysqli_error($conn);
  }
} else {
  echo "Invalid quiz ID.";
}

// Close the database connection
mysqli_close($conn);

// Redirect to a success page or perform other actions as needed
header("Location: food.php");
exit();
?>
