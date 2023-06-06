<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
body {
  background-color: #f2f2f2; /* Set a background color */
  background-image: url("quiz.jpg"); /* Set a background image */
  background-repeat: no-repeat; /* Prevent the background image from repeating */
  background-size: cover; /* Scale the background image to cover the entire body */
}
</style>
</head>
<body>
  
</body>
</html>

<?php include 'header.html'; ?>
<div class="quiz-container">
<form action="insertQuizResult.php" method="post">

<?php
require_once 'config.php';
// Get the quiz ID from the URL parameter
$quizId = $_GET['quiz_id'];
echo '<input value='.$quizId.' name="quiz_id" style="display:none">';
// Retrieve the quiz name from the database
$sqlQuiz = "SELECT quiz_name FROM quizzes WHERE quiz_id = $quizId";
$resultQuiz = mysqli_query($conn, $sqlQuiz);
$rowQuiz = mysqli_fetch_assoc($resultQuiz);
$quizName = $rowQuiz['quiz_name'];
echo '<input value='.$quizName.' name="quizName" style="display:none">';
// Retrieve the questions and answers for the quiz from the database
$sqlQuestions = "SELECT * FROM questions WHERE quiz_id = $quizId";
$resultQuestions = mysqli_query($conn, $sqlQuestions);
  
  echo "<h2 value='$quizName'>Quiz Name: $quizName</h2>";
  
$questionCount = 1;
if (mysqli_num_rows($resultQuestions) > 0) {

  while ($rowQuestion = mysqli_fetch_assoc($resultQuestions)) {
    $questionId = $rowQuestion['question_id'];
    $questionText = $rowQuestion['question_text'];

    // Display the question
    echo "<p>$questionCount.$questionText</p>";

    // Retrieve the answers for the question
    $sqlAnswers = "SELECT * FROM answers WHERE question_id = $questionId";
    $resultAnswers = mysqli_query($conn, $sqlAnswers);
    
    if (mysqli_num_rows($resultAnswers) > 0) {
      while ($rowAnswer = mysqli_fetch_assoc($resultAnswers)) {
        $answerId = $rowAnswer['answer_id'];
        $answerText = $rowAnswer['answer_text'];

        // Display the answer options as radio buttons
        echo "<input type='radio' name='answer_$questionId' value='$answerId'> $answerText<br>";
      }
    } else {
      echo "No answers available for this question.";
    }
  }

  // Display a submit button to submit the quiz
  echo "<button type='submit'>Submit Quiz</button>";
  echo "<input value='$questionCount' name='question_count' style='display:none'>";
  echo "</form>";
  $questionCount++;
} else {
  echo "No questions available for this quiz.";
}
?>
