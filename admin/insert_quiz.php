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
    
</body>
</html>

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

// Retrieve the quiz details from the form submission
$quizName = $_POST['quiz_name']; // Assuming you have an input field with the name "quiz_name" in your form
$questions = $_POST['questions']; // Assuming you have an array of input fields for question texts in your form
$answers = $_POST['answers']; // Assuming you have a multi-dimensional array of input fields for answers in your form
var_dump($_POST['answers']);
var_dump($_POST['questions']);

// Insert the quiz name into the "quizzes" table
$quizInsertQuery = "INSERT INTO quizzes (quiz_name) VALUES ('$quizName')";
$result = mysqli_query($connection, $quizInsertQuery);

if (!$result) {
  die("Quiz insertion failed.");
}

// Retrieve the newly inserted quiz ID
$quizId = mysqli_insert_id($connection);

// Iterate over the questions and answers arrays
for ($i = 0; $i < count($questions); $i++) {
  $questionText = $questions[$i];
  

  // Insert the question into the "questions" table
  $questionInsertQuery = "INSERT INTO questions (question_text) VALUES ('$questionText')";
  $result = mysqli_query($connection, $questionInsertQuery);

  if (!$result) {
    die("Question insertion failed: " . mysqli_error($connection));
  }

  // Retrieve the newly inserted question ID
  $questionId = mysqli_insert_id($connection);

  // Insert the question ID along with the quiz ID into the "quiz_questions" table
  $quizQuestionInsertQuery = "INSERT INTO quiz_questions (quiz_id, question_id) VALUES ('$quizId', '$questionId')";
  $result = mysqli_query($connection, $quizQuestionInsertQuery);

  if (!$result) {
    die("Quiz-Question insertion failed.");
  }

  for ($i = 1; $i <= count($answers); $i++) {
    $answerOptions = $_POST['answers'][$i];
  // Insert the answer options into the "answers" table
  foreach ($answerOptions as $answer) {
    $answerText = $answerOptions[$i-1];
    $isCorrect = ($answer['correct_answers'] == 1) ? 1 : 0;

    $answerInsertQuery = "INSERT INTO answers (question_id, answer_text, is_correct) VALUES ('$questionId', '$answerText', $isCorrect)";
    $result = mysqli_query($connection, $answerInsertQuery);

    if (!$result) {
      die("Answer insertion failed.");
    }
  }
}
}

// Close the connection
mysqli_close($connection);

// Redirect to a success page or perform other actions as needed
// header("Location: quiz_created.php");
// exit();
?>