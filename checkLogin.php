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

$sql = "SELECT `Account_id`,`Password`, `FirstName`,`LastName` FROM `Accounts` WHERE `Email` = '$email'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if(!$result || mysqli_num_rows($result)==0)
{
    ?>
        <div class="alert alert-danger" role="alert">
            Account not found, Please, enter correct email address and password.
        </div>
    <?php
}
else if($row["Password"] != $password){

    ?>
    <div class="alert alert-danger" role="alert">
        Account not found, Please, enter correct email address and password.
    </div>
    <?php
}
else {
    ?>
    <div class="alert alert-primary" role="alert">
        Login successful!
    </div>
    <div class="alert alert-primary" role="alert">
        Welcome back <?php echo "{$row["FirstName"]}"." "."{$row["LastName"]} ";  ?>
    </div>

    <?php
    $user = $row["Account_id"];
    header('Location: home.php?user='.$user);
    exit;

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css" type="text/css">
    <script type="text/javascript" src="index.js"></script>
    <meta charset="UTF-8">
    <title>Log in - Page</title>
</head>
<body>
<div class="login-form">
    <form action="checkLogin.php" onsubmit=" return validateLogin()" method="POST">
        <div class="form-group">
            <h3>Log in</h3>
            <small id="emailHelp" class="form-text text-muted"> Do you have an account? <a href="index.html">Sign up</a> </small>
            <label for="inputEmail">Email address</label>
            <input type="email" class="form-control" id="inputEmail" name="inputEmail" aria-describedby="emailHelp" placeholder="Enter email" >
        </div>
        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password" >
        </div>
        <button type="submit" onclick=" return validateLogin()" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
