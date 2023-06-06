<?php
include 'header.html';

if($_GET){
    $quizMarks = $_GET['score'];
    $totalQuestions = $_GET['quesC']; 
}else{
  echo "Url has no user";
}

// Calculate the percentage score
$percentageScore = ($quizMarks / $totalQuestions) * 100;

// Generate the congratulations message based on the percentage score
$congratulationsMessage = '';
if ($percentageScore >= 80) {
    $congratulationsMessage = 'Congratulations! You did an excellent job!';
} elseif ($percentageScore >= 60) {
    $congratulationsMessage = 'Congratulations! You did well!';
} else {
    $congratulationsMessage = 'Good effort! Keep practicing to improve!';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz Result</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
body {
  background-color: #f2f2f2; /* Set a background color */
  background-image: url("quiz.jpg"); /* Set a background image */
  background-repeat: no-repeat; /* Prevent the background image from repeating */
  background-size: cover; /* Scale the background image to cover the entire body */
}
.container {
    width: 80%;
    max-width: 600px;
    margin: 0 auto;
    text-align: center;
    background-color: white;
    justify-content: center;
}
.success-message {
    font-size: 24px;
    margin-bottom: 20px;
}
.score-message {
    font-size: 18px;
    margin-bottom: 10px;
}
.congratulations-message {
    font-size: 16px;
}
</style>
</head>
<body>
    <div class="container">
        <h2>Quiz Result</h2>
        <div class="success-message">Quiz submitted successfully!</div>
        <div class="score-message">You scored <?php echo $quizMarks; ?>/<?php echo $totalQuestions; ?> in the quiz.</div>
        <div class="congratulations-message"><?php echo $congratulationsMessage; ?></div>
    </div>
</body>
</html>
