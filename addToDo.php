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

session_start();
$user_ID = $_SESSION['$user_ID'];

$date = $_POST['date'];
$title = $_POST['title'];
$description  = $_POST['description'];


$sql = "INSERT INTO `Assignments` (`Assignment_date`, `Assignment_title`,`Assignment_description`,`Assignment_status_id`) VALUES ('$date', '$title','$description', '1');";
$result = mysqli_query($conn, $sql) or die("Bad query");

$sql = "SELECT `Assignment_id` FROM `Assignments` WHERE `Assignment_date` = '$date' AND `Assignment_title` = '$title'";
$result = mysqli_query($conn, $sql) or die("Bad query");

$row = mysqli_fetch_array($result);
$assignment_id = $row["Assignment_id"];

$sql = "INSERT INTO `Accounts_Assignment`(`Account_id`, `Assignment_id`) VALUES ('$user_ID','$assignment_id')";
$result = mysqli_query($conn, $sql) or die("Bad query");



header('Location: home.php?user=' . $user_ID);
exit;


?>
