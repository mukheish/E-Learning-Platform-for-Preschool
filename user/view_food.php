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
  background-color: beige; /* Set a background color */
  /* background-image: url("5.png"); Set a background image */
  background-repeat: no-repeat; /* Prevent the background image from repeating */
  background-size: cover; /* Scale the background image to cover the entire body */
}
.container {
  display: flex;
}

.sidebar {
  flex-basis: 25%; /* 1 part out of 4 (1:3 ratio) */
  /* background-color: #f1f1f1; */
}

.main-content {
  flex-basis: 75%; /* 3 parts out of 4 (1:3 ratio) */
  background-color: #fff;
}

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
  max-width: 206px;
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

/* Styling for the modal */
.modal {
  display: none;
  position: fixed;
  z-index: 9999;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: fit-content;
  height: fit-content;
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

.add-button {
  background-color: #4CAF50; /* Set the background color */
  border: none; /* Remove the border */
  color: white; /* Set the text color */
  padding: 10px 20px; /* Add padding to the button */
  text-align: center; /* Align the text in the center */
  text-decoration: none; /* Remove any text decoration */
  display: inline-block; /* Display the button as an inline element */
  font-size: 16px; /* Set the font size */
  cursor: pointer; /* Add a cursor pointer on hover */
  border-radius: 4px; /* Add rounded corners */
  margin: 20px;
}

.add-button:hover {
  background-color: #45a049; /* Change the background color on hover */
}
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

.close:hover {
  color: black;
}
/* Additional styling as needed */
.container-title {
  background-color: #f2f2f2;
  padding: 10px;
  margin-bottom: 10px;
  text-align: center;
  border-radius: 5px;
}

.container-title-text {
  color: #333;
  font-size: 20px;
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 2px;
}

.sidebar-section {
  background-color: #f2f2f2;
  padding: 10px;
  border-radius: 5px;
}

.sidebar-section-title {
  color: #333;
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
}

.sidebar-menu {
  list-style: none;
  padding: 0;
  margin: 0;
}

.sidebar-menu li {
  margin-bottom: 5px;
}

.sidebar-menu a {
  display: block;
  padding: 5px;
  color: #333;
  text-decoration: none;
  transition: background-color 0.3s ease;
}

.sidebar-menu a:hover {
  background-color: #ddd;
}

</style>
</head>
<body>
<?php 
require_once 'config.php';
include 'header.html'; 
$aid=$_SESSION['user_id'];

?>

    
    <!-- Button to trigger the modal -->
<!-- <button class="modal-btn">Open Modal</button> -->

<!-- The modal -->
<div class="modal" id="add-food">
  <div class="modal-content">
  <span class="close">&times;</span>
  <form class="report-card-form" action="add_allergy.php" method="POST">
  <h2 style="text-align:center;">Report Card</h2>
  <br><br>
  <label for="student_name">Food Name:</label>
  <input type="text" name="food_name" id="student_name" required>
  <br><br>
    <label for="subject">Food Ingredients that is allergic:</label>
    <input type="text" id="subject_math" name="subject_math" required>
    <br><br>
    <label for="subject_science">Comments:</label>
  <input type="text" name="comment" id="subject_science" required>
  <br><br>
    <input style="text-align: center;" type="submit" value="Add Food">
    
</form>
    <div id="modal-data"></div>
  </div>
</div>


  
  
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
$sql = "SELECT * FROM food";
$result = mysqli_query($conn, $sql);
$sql2 = "SELECT * FROM food_allergy";
$result2 = mysqli_query($conn, $sql2);

echo  '<div class="container">';
echo '<button class="add-button" onclick="showFood()">Report an allergy</button>';
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $foodId = $row['ID'];
    $foodName = $row['food_name'];
    $foodContent = $row['food_content'];

    // Display the quiz card
  

    echo  '<div class="main-content">';
    echo  '<h2 class="container-title">Food Menu</h2>';
    echo '<div class="quiz-card">';
    echo '<button class="delete-btn" style="float:right;"onclick="confirmDelete(' . $foodId . ')"><i class="fas fa-trash red-trash"></i></button>';
    echo '<h3>Food : ' . $foodName . '</h3>';
    echo '<h4>' . $foodContent . '</h4>';
    echo '</div>';
    echo '</div>';
    
  }
} else {
  echo "The food menu is empty.";
}

echo '</div>';
?>

<!-- JavaScript to confirm deletion -->
<script>
    function confirmDelete(quizId) {
        if (confirm("Are you sure you want to delete this quiz?")) {
            // Redirect to deleteQuiz.php with the quiz ID
            window.location.href = "deleteFood.php?food_id=" + foodId;
        }
    }

    function showFood(){
        
    $('.modal').css('display', 'block');
    document.getElementById('add-food').style.display="block";
    }

    // Get the modal element
var modal = document.getElementById("add-food");

// Get the close button element
var closeButton = document.getElementsByClassName("close")[0];

// Function to open the modal
function openModal() {
  modal.style.display = "block";
}

// Function to close the modal
function closeModal() {
  modal.style.display = "none";
}

// Event listener for the close button
closeButton.addEventListener("click", closeModal);

// Event listener for outside click to close the modal
window.addEventListener("click", function (event) {
  if (event.target == modal) {
    closeModal();
  }
});

</script>