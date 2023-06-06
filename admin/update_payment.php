<?php 
require_once 'config.php';
include 'header.html'; 
$aid=$_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<style>
body {
  background-color: #f2f2f2; /* Set a background color */
  background-image: url("payment.jpg"); /* Set a background image */
  background-repeat: no-repeat; /* Prevent the background image from repeating */
  background-size: cover; /* Scale the background image to cover the entire body */
}
  .payment-form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f5f5f5;
  }

  .form-group {
    margin-bottom: 15px;
  }

  .form-label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
  }

  .form-input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }

  .form-button {
    display: inline-block;
    padding: 8px 12px;
    border: none;
    border-radius: 4px;
    background-color: #4caf50;
    color: white;
    cursor: pointer;
  }

  .form-button:hover {
    background-color: #45a049;
  }
</style>

<body>
<html>
<div class="payment-form">
<h2>Update Payment Status</h2>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the selected student ID from the form
    $selectedStudentId = $_POST['student'];
    
    // Retrieve the student details, pending payment, and payment status
    $sqlDetails = "SELECT student_name, fees_pending, payment_status, p_month FROM users WHERE ID = $selectedStudentId";
    $resultDetails = mysqli_query($conn, $sqlDetails);
    
    if (mysqli_num_rows($resultDetails) > 0) {
        // Display the student details in a form
        $rowDetails = mysqli_fetch_assoc($resultDetails);
        $studentName = $rowDetails['student_name'];
        $pendingPayment = $rowDetails['fees_pending'];
        $paymentStatus = $rowDetails['payment_status'];
        $amount = $rowDetails['p_month'];
        
        
        echo "<form id='payment-form' action='update_payment_process.php' method='post'>";
        echo "<label for='student-name' class='form-label'>Student Name:</label>";
        echo "<input type='text' id='student-name'  value='$studentName' class='form-input' readonly><br>";
        echo "<input type='text' style='display:none;' name='studentname' value='$selectedStudentId' class='form-input'><br>";

        echo "<label for='pending-payment' class='form-label'>Pending Payment:</label>";
        echo "<input type='text' id='pending-payment' name='pendingpayment' value='$pendingPayment' class='form-input' ><br>";

        echo "<label for='payment-status' class='form-label'>Payment Status:</label>";
        echo "<input type='text' id='payment-status' name='paymentstatus' value='pending' class='form-input' ><br>";

        echo "<label for='amount' class='form-label'>Due for:</label>";
        echo "<input type='text' id='amount' name='amount' value='$amount' class='form-input'><br>";

        echo "<input type='hidden' name='student-id' value='$selectedStudentId'>";
        echo "<input class='select-btn' type='submit' value='Update Payment' class='submit-button'>";
        echo "</form>";
    } else {
        // No details found for the selected student
        echo "No details found for the selected student.";
    }
}
?>
</div>
    </html>
</body>

