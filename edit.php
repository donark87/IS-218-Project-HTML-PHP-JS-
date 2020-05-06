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

$assignmentID = $_POST['Assignment_id'];
$date = $_POST['date'];
$title =$_POST['title'];
$description  = $_POST['description'];



$sql = "UPDATE `Assignments` SET `Assignment_date`= '$date',`Assignment_title`='$title',`Assignment_description`='$description' WHERE `Assignment_id` = '$assignmentID' ";
$result = mysqli_query($conn, $sql) or die("Bad query");

if($result){
    echo '<script>alert("Data updated") </script>';
    header('Location: home.php?user=' . $user_ID);

}




?>