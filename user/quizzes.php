<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Card</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-qg86fploS+EGjmm19WiPIxBv0g9iU6Do+ZDqQk64p7zYugpBteA5hncsfEsYKvFhb2z02RbAJKqAPgz3MELMmw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
<style>
body {
  background-color: #f2f2f2; /* Set a background color */
  background-image: url("quiz.jpg"); /* Set a background image */
  background-repeat: no-repeat; /* Prevent the background image from repeating */
  background-size: cover; /* Scale the background image to cover the entire body */
}

.container {
  display: flex;
}

.main-content {
  flex-basis: 70%; /* ratio */
  /* background-color: #fff; */
  margin: 30px;
  /* opacity: 0.9; */
}

.sidebar {
  display: flex;
  flex-basis: 30%;
  margin: 30px;
  background-color: #ffffff;
  border-radius: 8px;
  flex-wrap: wrap;
  justify-content: center;
  margin-top: 50px;
  /* opacity: 0.9; */
}

.quiz-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start;
  align-items: flex-start;
  max-width: 1200px; /* Adjust the max width as needed */
  margin: 0 auto;
  /* display: inline; */
}

.quiz-card {
  max-width: 250px;
  max-height: 200px;
  margin: 10px;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: #f5f5f5;
  flex-basis: 300px;
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

.card {
  width: 300px;
  border: 1px solid #ddd;
  border-radius: 5px;
  padding: 20px;
  margin: 10px;
  text-align: center;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  background-color: #fff;
}
.card h3 {
  margin-bottom: 20px;
}
.card p {
    color: #666;
}
.card .score {
    font-size: 36px;
    margin-bottom: 10px;
    color: #4caf50;
}
.card .icon {
    font-size: 48px;
    margin-bottom: 10px;
    color: #4caf50;
}
.card.blue {
    background-color: #e3f2fd;
}
.card.blue .icon {
    color: #2196f3;
}
.card.red {
    background-color: #ffebee;
}
.card.red .icon {
    color: #f44336;
}
.card.green {
    background-color: #e8f5e9;
}
.card.green .icon {
    color: #4caf50;
}
</style>
<?php 
require_once 'config.php';
include 'header.html'; 
$aid=$_SESSION['user_id'];
?>
</head>
<body>
<div class="container">
<div class="main-content">



<?php



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
echo '</div>'
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



<div class="sidebar">
  <h2> Past Quiz that has been completed</h2>
<?php
// Assuming you have a user ID to filter the quiz results
$userId = 1; // Example value

// Retrieve the quiz results with the highest score and total score for each quiz for the given user
$sql = "SELECT MAX(score) AS highest_score, total_score, quiz_name, quiz_id FROM results WHERE user_id = $userId GROUP BY quiz_id";
$result = mysqli_query($conn, $sql);

// Check if there are any quiz results
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $quizId = $row['quiz_id'];
    $highestScore = $row['highest_score'];
    $totalScore = $row['total_score'];
    $quizName = $row['quiz_name'];

    // Retrieve the quiz details
    // $sqlQuiz = "SELECT quiz_name FROM quizzes WHERE quiz_id = $quizId";
    // $resultQuiz = mysqli_query($conn, $sqlQuiz);
    // $quizName = mysqli_fetch_assoc($resultQuiz)['quiz_name'];

    // Display the quiz details, highest score, and total score
    $cardColor = "";
    if ($highestScore == $totalScore) {
      $cardColor = "green";
    } elseif ($highestScore >= ($totalScore * 0.75)) {
      $cardColor = "blue";
    } else {
      $cardColor = "red";
    }

    echo '<div class="card '.$cardColor.'">';
    echo '<i class="icon fa fa-star"></i>';
    echo '<h3>'.$quizName.'</h3>';
    echo '<p>Highest Score: '.$highestScore.'</p>';
    echo '<p>Total Score: '.$totalScore.'</p>';
    echo '</div>';
  }
} else {
  // No past quiz results found
  echo "No past quiz results available.";
}
?>
</div>
</div>
</body>
</html>
