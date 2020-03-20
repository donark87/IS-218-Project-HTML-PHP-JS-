<?php

$servername = "sql2.njit.edu";
$database = "dp663";
$username = "dp663";
$password = "rlxqcbSd";

// Create connection

$conn = new mysqli($servername, $username, $password, $database);

// Check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$email = $_POST['inputEmail'];
$password = $_POST['inputPassword'];
$firstName = $_POST['inputFirstName'];
$lastName= $_POST['inputLastName'];
$college = $_POST['inputCollege'];
$major = $_POST['inputMajor'];

$sql = "INSERT INTO `Accounts`(`Email`, `Password`, `FirstName`, `LastName`, `College`, `Major`) VALUES ('$email', '$password', '$firstName', '$lastName', '$college', '$major')";

$result = mysqli_query($conn, $sql) or die("Bad query");

?>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title>Log in - Page</title>
</head>
<body>
<div class="alert alert-primary" role="alert">
    Your account successfully created. Please, <a href="logIn.html" class="alert-link">Log in </a> with your email address and password.
</div>
