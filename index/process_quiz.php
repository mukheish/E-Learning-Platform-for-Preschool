
<?php


// Assuming you have already established a database connection
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "psms"; // Replace with your database name

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Assuming you have retrieved the quiz data from the form submission
$quizName = $_POST['quiz_name'];
$questions = $_POST['questions'];
$answers = $_POST['answers'];
$correctAnswers = $_POST['correct_answers'];

// Insert the quiz name into the database
$sqlQuiz = "INSERT INTO quizzes (quiz_name) VALUES ('$quizName')";
if (mysqli_query($conn, $sqlQuiz)) {
  $quizId = mysqli_insert_id($conn); // Get the last inserted quiz ID

  // Process the questions and answers
  for ($i = 0; $i < count($questions); $i++) {
    $questionText = $questions[$i];
    $answerOptions = $answers[$i];
    $correctAnswer = $correctAnswers[$i];

    // Insert the question into the database
    $sqlQuestion = "INSERT INTO questions (quiz_id, question_text) VALUES ($quizId, '$questionText')";
    if (mysqli_query($conn, $sqlQuestion)) {
      $questionId = mysqli_insert_id($conn); // Get the last inserted question ID

      // Insert the answer options into the database
      foreach ($answerOptions as $index => $answerOption) {
        $answerText = $answerOption;
        $isCorrect = ($index == $correctAnswer) ? 1 : 0;

        $sqlAnswer = "INSERT INTO answers (question_id, answer_text, is_correct) VALUES ($questionId, '$answerText', $isCorrect)";
        if (!mysqli_query($conn, $sqlAnswer)) {
          echo "Error: " . $sqlAnswer . "<br>" . mysqli_error($conn);
        }
      }
    } else {
      echo "Error: " . $sqlQuestion . "<br>" . mysqli_error($conn);
    }
  }
} else {
  echo "Error: " . $sqlQuiz . "<br>" . mysqli_error($conn);
}




// Close the database connection
mysqli_close($conn);
?>