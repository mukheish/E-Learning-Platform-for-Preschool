<?php
include 'config.php';
// Check if the user ID is provided
if (!isset($_GET['id'])) {
    header("Location: manage.php");
    exit();
}

// Get the user ID from the query string
$userId = $_GET['id'];

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the input
    $newPassword = $_POST['newpassword'];
    // Perform necessary password validation and sanitization here

    // Update the password in the database
    $sqlUpdatePassword = "UPDATE admin SET password = '$newPassword' WHERE ID = '$userId'";
    // Execute the update query using mysqli_query()
    $sqlUpdatePassword = "UPDATE admin SET password = '$newPassword' WHERE ID = '$userId'";
    $resultUpdatePassword = mysqli_query($conn, $sqlUpdatePassword);
    if ($resultUpdatePassword) {
        // Password updated successfully
        header("Location: manage.php");
        exit();
    } else {
        // Error updating password
        echo "Error updating password: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);

    // Redirect back to the user display page
    
}

// Retrieve the user details from the database based on the provided user ID
// Perform necessary database queries using the user ID to fetch the relevant user details
// Store the user details in variables

// Display the HTML form to alter the password
?>

<!DOCTYPE html>
<html>
<head>
    <title>Alter Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Alter Password</h2>
        <form action="alter_password3.php?id=<?php echo $userId; ?>" method="post">
            <label for="new-password">New Password:</label>
            <input type="password" id="new-password" name="newpassword" required>

            <input type="submit" value="Alter Password">
        </form>
    </div>
</body>
</html>
