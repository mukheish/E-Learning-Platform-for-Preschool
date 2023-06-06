<!DOCTYPE html>
<html>
<head>
  <title>Create Quiz</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    .question {
      margin-bottom: 20px;
    }

    .options {
      margin-top: 10px;
    }

    .answer {
      margin-bottom: 5px;
    }
    body {
  font-family: Arial, sans-serif;
}

h1 {
  text-align: center;
}

form {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #D4F1F4;
  box-shadow: 5px 10px 8px 10px #888888;
}

label {
  font-weight: bold;
  display: block;
  margin-bottom: 5px;
}

input[type="text"],
input[type="radio"] {
  margin-bottom: 10px;
}

.button-container {
  text-align: center;
  margin-top: 20px;
}

#add-question {
  background-color: #4CAF50;
  color: white;
  padding: 8px 12px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.question {
  margin-bottom: 20px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.answer-options {
  margin-top: 10px;
}

.answer {
  margin-bottom: 5px;
}

.answer input[type="text"] {
  margin-right: 10px;
}

.answer label {
  margin-left: 5px;
}

.question {
  background-color: beige;
  box-shadow: 5px 10px 8px 10px #888888;
  padding: 10px;
  margin: 20px;
}

#correct {
  background-color: transparent;
}

</style>
</head>
<body>
  <h1>Create Quiz</h1>
  <form id="quizForm" action="add_quiz.php" method="POST">
    <label for="quiz-name">Quiz Name:</label>
    <input type="text" name="quiz_name" id="quiz-name" required>

    <div id="questions-container">
      <div class="question">
        <label for="question-1">Question 1:</label>
        <input type="text" name="questions[]" id="question-1" required>
        <div class="options">
          <label>Answer Options:</label>

          <div class="answer1">
            <input id="correct" type="radio" name="correct_answers" value="0">
            <input id="text1" type="text" name="answers" required>
          </div>

          <div class="answer1">
            <input id="correct" type="radio" name="correct_answers" value="0">
            <input id="text2" type="text" name="answers" required> 
          </div>

          <div class="answer1">
            <input id="correct" type="radio" name="correct_answers" value="0">
            <input id="text3" type="text" name="answers" required> 
          </div>

        </div>
      </div>
    </div>

    <button type="button" id="add-question">Add Question</button>
    <br><br>
    <input type="submit" value="Create Quiz">
  </form>
</body>
<script>
  // Function to calculate the score

  function collectQuestion(){
    var ans=[];
    
    document.getElementById("correct").value = "correct";
    console.log("the function runs");
    var score = 0;
    
    const element = document.querySelectorAll('.question');
    for (var i = 1; i <= element.length; i++) {
      var questionBox ="question-"+i;
      var questionText = document.getElementById(questionBox).value;
      var a = '.answer'+i;
      const elements = document.querySelectorAll(a);
      
      for (var i = 1; i <= elements.length; i++) {
        score +=1;
        console.log(score);
        var answerBox ="text"+i;
        
        var answerText = document.getElementById(answerBox).value;
        
        console.log(questionText);
        //document.querySelector('input[name="answers"]:checked').value;
        ans.push([questionText, answerText, "correct"]);
        
      }
      console.log(ans);
    }
  }


  // Attach the calculateScore function to the form submission event
  var quizForm = document.getElementById('quizForm');
  quizForm.addEventListener('submit', collectQuestion);
</script>

<script>
  
  window.addEventListener("DOMContentLoaded", function() { // 'window.onload = function...' also works 
  
  const yourForm = document.getElementById("quizForm");
  //const firstForm = document.getElementById("firstFormID");
  yourForm.addEventListener("submit", function(e) { // 'yourForm.onsubmit = function...` also works too
    
    e.preventDefault(); 
    const data = new FormData(yourForm); 
    const action = e.target.action; 
    fetch(action, { 
      method: 'POST', 
      body: data, 
    }).then((data) => {
      if (data.Status == "Approved") {
        // finished, you can do whatever you want here
       
        
      }
    })
  })
});


</script>
<?php

?>
</html>
