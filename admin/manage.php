<?php 
require_once 'config.php';
include 'header.html'; 
$aid=$_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mange Users</title>
    <link rel="stylesheet" type="text/css" href="login.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h2 {
            margin-top: 40px;
            margin-bottom: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .no-data {
            font-style: italic;
            color: #888888;
        }

        /* Colors for the tables */
        .users-table {
            background-color: #f7fafc;
        }

        .admins-table {
            background-color: #fef2f2;
        }

        .teachers-table {
            background-color: #f2f7f5;
        }
    </style>
</head>
<body>
<div class="container">
        <h2>Users</h2>
        <table class="users-table">
            <thead>

            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Parent First Name</th>
                <th>Parent Last Name</th>
                <th>Student Name</th>
                <th>Student Age</th>
                <th>Change Password</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Retrieve users from the database
            $sqlUsers = "SELECT * FROM users";
            $resultUsers = mysqli_query($conn, $sqlUsers);

            if (mysqli_num_rows($resultUsers) > 0) {
                while ($rowUser = mysqli_fetch_assoc($resultUsers)) {
                    echo "<tr>";
                    echo "<td>".$rowUser['ID']."</td>";
                    echo "<td>".$rowUser['username']."</td>";
                    echo "<td>".$rowUser['email']."</td>";
                    echo "<td>".$rowUser['parent_Fname']."</td>";
                    echo "<td>".$rowUser['parent_Lname']."</td>";
                    echo "<td>".$rowUser['student_name']."</td>";
                    echo "<td>".$rowUser['student_age']."</td>";
                    echo "<td><button class='select-btn btn-alter' onclick='alterPassword(".$rowUser['ID'].")'>Change</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No users found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <h2>Admins</h2>
        <table class="admins-table">
            <thead>
            <tr>
                <th>Admin ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Change Password</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Retrieve admins from the database
            $sqlAdmins = "SELECT * FROM admin";
            $resultAdmins = mysqli_query($conn, $sqlAdmins);

            if (mysqli_num_rows($resultAdmins) > 0) {
                while ($rowAdmin = mysqli_fetch_assoc($resultAdmins)) {
                    echo "<tr>";
                    echo "<td>".$rowAdmin['ID']."</td>";
                    echo "<td>".$rowAdmin['username']."</td>";
                    echo "<td>".$rowAdmin['email']."</td>";
                    echo "<td><button class='select-btn btn-alter' onclick='alterPassworddd(".$rowAdmin['ID'].")'>Change</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No admins found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <h2>Teachers</h2>
        <table class="teachers-table">
            <thead>
            <tr>
                <th>Teacher ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Address</th>
                <th>Change Password</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Retrieve teachers from the database
            $sqlTeachers = "SELECT * FROM teacher";
            $resultTeachers = mysqli_query($conn, $sqlTeachers);

            if (mysqli_num_rows($resultTeachers) > 0) {
                while ($rowTeacher = mysqli_fetch_assoc($resultTeachers)) {
                    echo "<tr>";
                    echo "<td>".$rowTeacher['ID']."</td>";
                    echo "<td>".$rowTeacher['username']."</td>";
                    echo "<td>".$rowTeacher['email']."</td>";
                    echo "<td>".$rowTeacher['address']."</td>";
                    echo "<td><button class='select-btn btn-alter' onclick='alterPasswordd(".$rowTeacher['ID'].")'>Change</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No teachers found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    </div>
    <script>
        function alterPassword(userId) {
            // Redirect to the alter password page with the selected user ID
            window.location.href = "alter_password.php?id=" + userId;
        }
        function alterPasswordd(userId) {
            // Redirect to the alter password page with the selected user ID
            window.location.href = "alter_password2.php?id=" + userId;
        }
        function alterPassworddd(userId) {
            // Redirect to the alter password page with the selected user ID
            window.location.href = "alter_password3.php?id=" + userId;
        }
    </script>
</body>
</html>
