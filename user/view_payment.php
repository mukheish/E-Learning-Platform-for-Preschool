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
.container {
  display: flex;
}

.main-content {
  flex-basis: 50%; /* ratio */
  /* background-color: #fff; */
  justify-content: center;
  margin: 30px;
  /* opacity: 0.9; */
}

.sidebar {
  display: flex;
  flex-basis: 50%;
  margin: 30px;
  background-color: lightgrey;
  border-radius: 8px;
  flex-wrap: wrap;
  margin-top: 50px;
  /* opacity: 0.9; */
  flex-direction: column;
  align-content: space-around;
}

.payment-card:hover {
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.payment-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  cursor: pointer;
}

.payment-header h3 {
  margin: 0;
}

.payment-details {
  display: none;
  margin-top: 20px;
}

.payment-details.show {
  display: block;
}
.cards {
  display: flex;
  flex-direction: column;
  height: 280px;
  width: 260px;
  background-color: #fff;
  border-radius: 10px;
  transition: 0.4s ease-out;
  position: relative;
  left: 0px;
}

.payment-card {
  width: 240px;
  padding: 20px;
  margin: 10px;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: box-shadow 0.3s ease;
  background-color: lightblue;
  
}

.payment-card:hover {
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.red {
  background-color: #ffcccb;
}

</style>
<body>
<div class="container">
  <div class="main-content">
<?php
// Assuming you have a database connection established

// Define the user ID
$userId = 123; // Replace with the desired user ID

// Retrieve details from the table
$sql = "SELECT * FROM users WHERE ID = $aid AND payment_status = 'pending'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Loop through the rows and display the details
    while ($row = mysqli_fetch_assoc($result)) {
        $pFName = $row['parent_Fname']; // Replace with the actual column name
        $pLName = $row['parent_Lname']; // Replace with the actual column name
        $sName = $row['student_name'];
        $age = $row['student_age'];
        $fee = $row['fees_pending'];
        $pending = ['payment_status'];
        $month = $row['p_month'];

        echo '<div class="cards ">
          <div class="payment-card red">
            <div class="payment-header" onclick="togglePaymentDetails(1)">
              <h3>Outstanding Payment #1</h3>
              <span class="payment-amount">RM  '.$fee.' </span>
            </div>
            <div class="payment-details" id="payment-details-1">
              <p><strong>Parents Name:</strong>  '.$pFName.' '.$pLName.'</p>
              <p><strong>Kids Name:</strong>'.$sName.'</p>
              <p><strong>Payment for Month :</strong> '.$month.'</p>   
            </div>
            <form action="update_payment.php" method="post">
            <input style="display:none" name="student" value='.$aid.'>
            <button class="select-btn">pay</button>
            </form>
          </div>
          </div>
          ';
    }
} else {
    echo "You have no pending payment to be done as of now, Thank You  .";
}
?>


</div>

</div>

<script>
  // Get all payment elements
  function togglePaymentDetails(paymentId) {
  var paymentDetails = document.getElementById('payment-details-' + paymentId);
  paymentDetails.classList.toggle('show');
}



</script>

</body>
</html>