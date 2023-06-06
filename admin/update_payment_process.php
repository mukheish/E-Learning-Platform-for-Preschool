<?php
include 'config.php';


if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the selected student and payment status from the form
  $studentId = $_POST['studentname'];
  $paymentStatus = $_POST['paymentstatus'];
  $amount = $_POST['amount'];

  // Update the payment status in the database
  $sqlUpdate = "UPDATE users SET payment_status = 'pending', p_month = '$amount' WHERE ID = '$studentId'";
  
  $resultUpdate = mysqli_query($conn, $sqlUpdate);

  if ($resultUpdate) {
    // Payment status updated successfully
    echo "Payment status updated successfully!";
  } else {
    // Failed to update payment status
    echo "Error updating payment status: " . mysqli_error($conn);
  }
}

// Close the database connection
mysqli_close($conn);
header("Location: payment.php");
exit();
?>
