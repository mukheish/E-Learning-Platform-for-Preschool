<?php
// Include the database connection and config file
include 'config.php';

// Check if quiz ID is provided
if (isset($_GET['quiz_id'])) {
  $quizId = $_GET['quiz_id'];

  // Delete the associated questions and answers
  $sqlDeleteAnswers = "DELETE FROM answers WHERE question_id IN (SELECT question_id FROM questions WHERE quiz_id = $quizId)";
  mysqli_query($conn, $sqlDeleteAnswers);

  $sqlDeleteQuestions = "DELETE FROM questions WHERE quiz_id = $quizId";
  mysqli_query($conn, $sqlDeleteQuestions);

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
header("Location: quizzes.php");
exit();
?>
