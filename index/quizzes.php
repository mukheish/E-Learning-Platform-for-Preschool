<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizzes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous" />


<style>
.quiz-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
  align-items: flex-start;
  max-width: 1200px; /* Adjust the max width as needed */
  margin: 0 auto;
  /* display: inline; */
}

.quiz-card {
  max-width: 110px;
  margin: 10px;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: #f5f5f5;
}

.quiz-card h3 {
  font-size: 18px;
  margin-top: 0;
}

.quiz-card p {
  font-size: 14px;
}

.quiz-card a {
  display: block;
  text-align: center;
  padding: 6px 12px;
  background-color: #007bff;
  color: #fff;
  border-radius: 4px;
  text-decoration: none;
}

.quiz-card a:hover {
  background-color: #0056b3;
}

.red-trash {
  color: red;
}
</style>
</head>
<body>
    
</body>
</html>
<?php
require_once 'config.php';
function deleteQuiz($quizId) {
    // Connect to the database (make sure to include your configuration)
    // Delete the quiz
    $sqlDeleteQuiz = "DELETE FROM quizzes WHERE quiz_id = $quizId";
    if (mysqli_query($conn, $sqlDeleteQuiz)) {
        // Delete the associated questions
        $sqlDeleteQuestions = "DELETE FROM questions WHERE quiz_id = $quizId";
        mysqli_query($conn, $sqlDeleteQuestions);

        // Delete the associated answers
        $sqlDeleteAnswers = "DELETE FROM answers WHERE question_id IN (SELECT question_id FROM questions WHERE quiz_id = $quizId)";
        mysqli_query($conn, $sqlDeleteAnswers);

        echo "Quiz deleted successfully.";
    } else {
        echo "Error deleting quiz: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}

// Retrieve the available quizzes from the database
$sql = "SELECT * FROM quizzes";
$result = mysqli_query($conn, $sql);
echo '<div class="quiz-container">';
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $quizId = $row['quiz_id'];
    $quizName = $row['quiz_name'];
   

    // Display the quiz card
    
    echo '<div class="quiz-card">';
    echo '<button class="delete-btn" style="float:right;"onclick="confirmDelete(' . $quizId . ')"><i class="fas fa-trash red-trash"></i></button>';
    echo '<h3>Quiz Name: ' . $quizName . '</h3>';
    echo '<a href="quiz.php?quiz_id=' . $quizId . '" style="background-color: green">Start Quiz</a>';
    echo '</div>';
    
  }
} else {
  echo "No quizzes available.";
}
echo '</div>';
?>

<!-- JavaScript to confirm deletion -->
<script>
    function confirmDelete(quizId) {
        if (confirm("Are you sure you want to delete this quiz?")) {
            // Redirect to deleteQuiz.php with the quiz ID
            window.location.href = "deleteQuiz.php?quiz_id=" + quizId;
        }
    }
</script>