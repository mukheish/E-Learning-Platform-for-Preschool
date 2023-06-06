<?php
// Include the database connection and config file
include 'config.php';

// Check if the result_id is provided
if (isset($_POST['result_id'])) {
    $resultId = $_POST['result_id'];

    // Perform the deletion
    $sqlDelete = "DELETE FROM results WHERE result_id = $resultId";
    $resultDelete = mysqli_query($conn, $sqlDelete);

    if ($resultDelete) {
        // Deletion successful
        echo "Quiz deleted successfully.";
    } else {
        // Deletion failed
        echo "Failed to delete the quiz. Please try again.";
    }
} else {
    // result_id is not provided
    echo "Invalid request.";
}
header("Location: report.php");
        exit;
?>