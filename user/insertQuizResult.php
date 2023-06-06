<?php
require_once 'config.php';
// Get the quiz ID from the URL parameter
$userId=$_SESSION['user_id'];
$quizId = $_POST['quiz_id'];
$quesCount = $_POST['question_count'];
$quizName = $_POST['quizName'];
// Assuming you have retrieved the user ID, quiz ID, and other necessary data from the form submission
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

$score = 0; // Initialize the score

// Loop through the submitted answers
foreach ($_POST as $key => $value) {
  if (strpos($key, 'answer_') === 0) {
    $questionId = substr($key, strlen('answer_'));
    $selectedAnswerId = $value;

    // Retrieve the correct answer for the question
    $sqlCorrectAnswer = "SELECT is_correct FROM answers WHERE answer_id = $selectedAnswerId";
    $resultCorrectAnswer = mysqli_query($conn, $sqlCorrectAnswer);
    $rowCorrectAnswer = mysqli_fetch_assoc($resultCorrectAnswer);
    $isCorrect = $rowCorrectAnswer['is_correct'];

    // Check if the selected answer is correct
    if ($isCorrect) {
      $score++;
      echo $score;
    }
  }
}
$quizDate = date('Y-m-d');
// Insert the quiz result into the quiz_results table
$sqlInsertResult = "INSERT INTO results (user_id, quiz_id, quiz_name, student_name, score, total_score, quiz_date)
VALUES ('$userId', '$quizId', '$quizName', '$studentName', '$score', '$quesCount', '$quizDate')";
$resultInsertResult = mysqli_query($conn, $sqlInsertResult);

// Check if the insertion was successful
if ($resultInsertResult) {
    header("Location: quizSubmitted.php?score=".$score."&quesC=" . $quesCount);
    exit();
} else {
  echo "Error storing quiz result: " . mysqli_error($conn);
}

?>