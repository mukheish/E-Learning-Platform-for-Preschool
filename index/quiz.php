<?php
require_once 'config.php';
// Get the quiz ID from the URL parameter
$quizId = $_GET['quiz_id'];

// Retrieve the quiz name from the database
$sqlQuiz = "SELECT quiz_name FROM quiz WHERE quiz_id = $quizId";
$resultQuiz = mysqli_query($conn, $sqlQuiz);
$rowQuiz = mysqli_fetch_assoc($resultQuiz);
$quizName = $rowQuiz['quiz_name'];

// Retrieve the questions and answers for the quiz from the database
$sqlQuestions = "SELECT * FROM questions WHERE quiz_id = $quizId";
$resultQuestions = mysqli_query($conn, $sqlQuestions);

if (mysqli_num_rows($resultQuestions) > 0) {
  echo "<h2>$quizName</h2>";

  while ($rowQuestion = mysqli_fetch_assoc($resultQuestions)) {
    $questionId = $rowQuestion['question_id'];
    $questionText = $rowQuestion['question_text'];

    // Display the question
    echo "<p>$questionText</p>";

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
} else {
  echo "No questions available for this quiz.";
}
?>
