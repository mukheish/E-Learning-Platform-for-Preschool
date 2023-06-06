<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Card</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
body {
  background-color: #f2f2f2; /* Set a background color */
  background-image: url("4.png"); /* Set a background image */
  background-repeat: no-repeat; /* Prevent the background image from repeating */
  background-size: cover; /* Scale the background image to cover the entire body */
}

.container {
  display: flex;
}

.main-content {
  flex-basis: 70%; /* ratio */
  /* background-color: #fff; */
  justify-content: center;
  margin: 30px;
  /* opacity: 0.9; */
}

.sidebar {
  display: flex;
  flex-basis: 30%;
  margin: 30px;
  background-color: lightgrey;
  border-radius: 8px;
  flex-wrap: wrap;
  margin-top: 50px;
  /* opacity: 0.9; */
  flex-direction: column;
  align-content: space-around;
}

.sidebar2 {
  display: flex;
  flex-basis: 30%;
  margin: 30px;
  background-color: lightgrey;
  border-radius: 8px;
  flex-wrap: wrap;
  margin-top: 50px;
  /* opacity: 0.9; */
  flex-direction: column;
  align-content: space-around;
}
.card {
  display: flex;
  width: 216px;
  border: 1px solid #ddd;
  border-radius: 5px;
  padding: 20px;
  margin: 10px;
  text-align: center;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  background-color: #e8f5e9;
  justify-content: space-between;
  align-items: stretch;
  flex-wrap: nowrap;
  flex-direction: column;
  align-content: center;
}
</style>
</head>
<body>
<?php 
include 'header.html';
include 'config.php'; 
?>
  <div class="container">
  <div class="main-content">
  <div class="container-report">

  <form class="report-card-form" action="process_report_card.php" method="POST">
  <h2 style="text-align:center;">Report Card</h2>
  <br><br>
  <label for="student_name">Student Name:</label>
  <?php
// Retrieve data from the database
$sql = "SELECT ID, student_name FROM users";
$result = mysqli_query($conn, $sql);

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
  echo '<select class="custom-select" name="options">';

  // Iterate over the rows and create an option for each
  while ($row = mysqli_fetch_assoc($result)) {
    $optionId = $row['ID'];
    $optionName = $row['student_name'];

    echo '<option value="' . $optionName . '">' . $optionName . '</option>';
  }

  echo '</select>';
} else {
  echo 'No options available.';
}
?>
  
  <label for="marks">Marks:</label>
  
  <br><br>
    <label for="subject">Mathematics:</label>
    <input type="number" id="subject_math" name="subject_math" required>
    <br><br>
    <label for="subject">Science:</label>
    <input type="number" id="subject_science" name="subject_science" required>
    <br><br>
    <label for="subject">English:</label>
    <input type="number" id="subject_english" name="subject_english" required>
    <br><br>
    <input style="text-align: center;" type="submit" value="Submit Report Card">
    
</form>
</div>


</div>

<div class="sidebar">
  <h3> Quizzess done by students</h3>
<?php
// Retrieve past quizzes from the result table
$sqlQuizzes = "SELECT * FROM results ORDER BY quiz_date DESC";
$resultQuizzes = mysqli_query($conn, $sqlQuizzes);

// Check if any quizzes are found
if (mysqli_num_rows($resultQuizzes) > 0) {
    // Loop through each quiz result
    while ($rowQuiz = mysqli_fetch_assoc($resultQuizzes)) {
        $resultId = $rowQuiz['result_id'];
        $userId = $rowQuiz['user_id'];
        $quizId = $rowQuiz['quiz_id'];
        $studentName = $rowQuiz['student_name'];
        $score = $rowQuiz['score'];
        $totalScore = $rowQuiz['total_score'];
        $quizDate = $rowQuiz['quiz_date'];

        // Retrieve quiz details
        $sqlQuiz = "SELECT quiz_name FROM quizzes WHERE quiz_id = $quizId";
        $resultQuiz = mysqli_query($conn, $sqlQuiz);
        $quizName = mysqli_fetch_assoc($resultQuiz)['quiz_name'];

        // Display the quiz details and score
        echo "<div class='card quiz-card'>";
        echo "<h3>$quizName</h3>";
        echo "<p>Student: $studentName</p>";
        echo "<p>Score: $score   /   $totalScore</p>";
        echo "<p>Date: $quizDate</p>";

        // Add a delete button
        echo "<form action='deleteUserQuiz.php' method='post'>";
        echo "<input type='hidden' name='result_id' value='$resultId'>";
        echo "<button class='select-btn' type='submit'>Delete</button>";
        echo "</form>";

        echo "</div>";
    }
} else {
    echo "No past quizzes found.";
}
?>

</div>
</div>

</body>
</html>

