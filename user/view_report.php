<?php
  // session_start();
  include('config.php');
  //include('checklogin.php');
  include 'header.html';
  //check_login();
  $aid=$_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Card</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <style>
body {
  background-color: #f2f2f2; /* Set a background color */
  background-image: url("5.png"); /* Set a background image */
  background-repeat: no-repeat; /* Prevent the background image from repeating */
  background-size: cover; /* Scale the background image to cover the entire body */
}
.report-card {
  width: 600px;
  margin: 0 auto;
  margin-top: 25px;
  padding: 20px;
  border: 1px solid #ccc;
  background-color: #f9f9f9;
  font-family: Arial, sans-serif;
}

.report-card-header {
  text-align: center;
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 20px;
} 

.container {
  display: flex;
  flex-direction: column;
}

.sidebar {
  flex-basis: 60%;
  margin: 30px;
  background-color: #ffffff;
  border-radius: 8px;
  opacity: 0.9;
}

.sidebar h3{
  text-align: center;
  margin-bottom: 20px;
}

.textbox {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-bottom: 10px;
}
.quiz-title {
  display: flex;
  justify-content: center;
  font-size: 50px;
  margin: 25px;
  margin-bottom: 50px;
}

.main-content {
  flex-basis: 40%; /* ratio */
  /* background-color: #fff; */
}

.progress-container {
  position: relative;
}

.progress-bar {
  width: 100%;
  height: 20px;
  background-color: #e0e0e0;
  border-radius: 10px;
  overflow: hidden;
}

.progress-bar-fill {
  height: 100%;
  width: 0;
  background-color: #4caf50;
  transition: width 0.5s ease-in-out;
}

.achievements {
  position: relative;
  top: -7px; /* Adjust the value as needed */
  left: 0;
  width: 100%;
  text-align: center;
}


.star {
  display: inline-block;
  width: 70px;
  height: 70px;
  background-color: gold;
  clip-path: polygon(
    50% 0%,
    61.8% 35.3%,
    98.4% 35.3%,
    68.2% 57.1%,
    79.0% 91.4%,
    50% 70.6%,
    21.0% 91.4%,
    31.8% 57.1%,
    1.6% 35.3%,
    38.2% 35.3%
  );
  margin: 0 2px;
  outline: 1px solid #fff;
}
.star-outline {
  display: inline-block;
  width: 70px;
  height: 70px;
  background-color: transparent;
  clip-path: polygon(
    50% 0%,
    61.8% 35.3%,
    98.4% 35.3%,
    68.2% 57.1%,
    79.0% 91.4%,
    50% 70.6%,
    21.0% 91.4%,
    31.8% 57.1%,
    1.6% 35.3%,
    38.2% 35.3%
  );
  margin: 0 2px;
  outline: 1px solid #ccc;
}

#progress-star {
  display: flex;
  justify-content: center;
  font-size: 50px;
  margin: 25px;
}

  </style>
  
<?php
// Assuming you have established a database connection

// Get the user ID
$userId = $aid; // Replace with the actual user ID

// Retrieve all available quizzes
$sqlQuizzes = "SELECT quiz_id FROM quizzes";
$resultQuizzes = mysqli_query($conn, $sqlQuizzes);
$totalQuizzes = mysqli_num_rows($resultQuizzes);

// Retrieve the quizzes completed by the user
$sqlUserResults = "SELECT DISTINCT quiz_id FROM results WHERE user_id = '$userId'";
$resultUserResults = mysqli_query($conn, $sqlUserResults);
$completedQuizzes = mysqli_num_rows($resultUserResults);

// Check if the user has completed all quizzes
$hasCompletedAllQuizzes = ($totalQuizzes > 0 && $totalQuizzes == $completedQuizzes);

// Display the number of quizzes completed and the total quizzes
echo "<input type='number' id='num1' style='display:none;' value='$completedQuizzes'>";
echo "<input type='number' id='num2' style='display:none;' value='$totalQuizzes'>";


// Check if the user has completed all quizzes
if ($hasCompletedAllQuizzes) {
    echo "User has completed all quizzes";
} else {
    echo "User has not completed all quizzes";
}

?>

<?php
$query = "SELECT * FROM users WHERE ID = $aid";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 1) {
    // User credentials are valid, fetch the user record
    $user = mysqli_fetch_assoc($result);
  
    // Store the user ID in the session
    $studentName = $user['student_name'];
    $parentFname = $user['parent_Fname'];
    $parentLname = $user['parent_Lname'];
    $parentName = $parentFname . ' ' . $parentLname;
  }
  else{
    echo "invalid student ID";
  }
  // Construct the SQL query with the WHERE clause
$sql = "SELECT * FROM report_card WHERE student_name = '$studentName'";

// Execute the query
$result2 = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result2) {
    // Fetch the row from the result set
    $row = mysqli_fetch_assoc($result2);
    // Check if a row was found
    if ($row) {
      // Access the values in the row
      $reportId = $row['id'];
      $student = $row['student_name'];
      $malay = $row['malay_marks'];
      $math = $row['math_marks'];
      $science = $row['science_marks'];
      $english = $row['english_marks'];
      $teacherComments = $row['teacher_comments'];
        // ... and so on
    } else {
        echo "No row found with ID: $id";
    }
} else {
    echo "Error executing query: " . mysqli_error($conn);
}

?>
<div class="container">
<div class="sidebar">

<h1 class="quiz-title">Quiz Progress</h1>
<div class="progress-container">
  <div class="achievements">
    
    <span class="star"></span>
    <span class="star"></span>
    <span class="star"></span>
    <span class="star"></span>
    <span class="star"></span>
  </div>
  <div id="progress-star"></div>
  <div class="progress-bar">
  <div class="progress-bar-fill"></div>
  
  
</div>
<br><br>
<h3>This Progress bar represents the progress to quiz completion. Complete all the quizzes available to complete the progress bar</h3>

</div>
</div>
  
  <div class="main-content">
    <div class="report-card">
      <h2 class="report-card-header">Student Report Card</h2>
      <div class="student-details">
        <p><strong>Student Name:</strong> <?php echo $student ?></p>
        <p><strong>Parents Name:</strong> <?php echo $parentName?></p>
        <!-- <p><strong>Roll No:</strong> 12345</p> -->
      </div>
      <div class="subject-grade">
        <i class="fas fa-math fa-lg"></i>
        <span class="subject-name">Mathematics:</span>
        <span class="subject-grade-value"><?php echo $math . ' ' .'marks' ?></span>
      </div>
      <div class="subject-grade">
        <i class="fas fa-flask fa-lg"></i>
        <span class="subject-name">Science:</span>
        <span class="subject-grade-value"><?php echo $science . ' ' .'marks'?></span>
      </div>
      <div class="subject-grade">
        <i class="fas fa-book fa-lg"></i>
        <span class="subject-name">Malay:</span>
        <span class="subject-grade-value"><?php echo $malay . ' ' .'marks'?></span>
      </div>
      <div class="subject-grade">
        <i class="fas fa-book fa-lg"></i>
        <span class="subject-name">English:</span>
        <span class="subject-grade-value"><?php echo $english . ' ' .'marks'?></span>
      </div>
      <h3> Teacher's Comments: </h3>
      <h4><?php echo $teacherComments?></h4>
      <br><br>
      <form action="parentAddComment.php" method="post">
        <input style="display:none;" name="reportId" value="<?php echo $reportId?>">
        <h3> Add comments to your kid's report card</h3>
        <input class="textbox" name="parentComment" type="text" placeholder="write here...">
        <input type="submit" value="send comment">
      </form>
    </div>

    
</div>
  

</div>
<script>
// Set the progress dynamically (between 0 and 100)
var a = document.getElementById('num1').value;

var b = document.getElementById('num2').value;
var calc = parseInt(a)/parseInt(b);
console.log(calc);
var toshow = calc * 100;
var progress = 80; // Change this value to update the progress
var progressBarFill = document.querySelector('.progress-bar-fill');
var achievementsContainer = document.querySelector('.achievements');

progressBarFill.style.width = toshow + '%';

var numStars = Math.floor(toshow / 20); // Adjust the number of stars based on the progress
achievementsContainer.innerHTML = '<span class="star"></span>'.repeat(numStars);

var progressCount = numStars + " / 5 Stars Earned";
document.getElementById("progress-star").innerHTML = progressCount;
  </script>
</body>
</html>

