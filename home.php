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

$user_ID = $_GET['user'];
session_start();
$_SESSION['$user_ID'] = $user_ID;

$sql = "SELECT `Account_id`,`Email`,`FirstName`,`LastName`,`College`,`Major` FROM `Accounts` WHERE `Account_id` = '$user_ID'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css" type="text/css">
    <script type="text/javascript" src="index.js"></script>
    <meta charset="UTF-8">
    <title>Log in - Page</title>
    <script>
        $(document).ready(function () {
            $(document).on('click','a[data-role=update]', function () {
               var id = $(this).data('id');
                var date = $('#'+id).children('td[data-target=date]').text();
                var title = $('#'+id).children('td[data-target=title]').text();
                var description = $('#'+id).children('td[data-target=description]').text();

                $('#date').val(date);
                $('#title').val(title);
                $('#description').val(description);
                $('#Assignment_id').val(id);
                $('#myModal').modal('toggle');
            })
        });




    </script>
</head>
<body>
<nav class="navbar navbar-dark bg-dark justify-content-between">
    <a class="navbar-brand">Home</a>
    <form class="form-inline">
      <button class="btn btn-danger my-2 my-sm-0" type="submit"> <a style="color: white" href="signOut.html">Sign out!</a> </button>
    </form>
</nav>
<div class="card" style="width: 18rem; margin: 10px;">
    <div class="card-body">
        <h5 class="card-title">Name: <?php echo "{$row["FirstName"]}"." "."{$row["LastName"]} ";  ?> </h5>
        <h6 class="card-subtitle mb-2 text-muted">Email: <?php echo "{$row["Email"]}"; ?> </h6>
        <h6 class="card-subtitle mb-2 text-muted">College: <?php echo "{$row["College"]}"; ?> </h6>
        <h6 class="card-subtitle mb-2 text-muted">Major: <?php echo "{$row["Major"]}"; ?> </h6>
        <h6 class="card-subtitle mb-2 text-muted">ID: <?php echo "{$row["Account_id"]}"; ?> </h6>
    </div>
</div>

<!--Table for Assignment "To-DO"-->
<?php


$sql = "SELECT A.Account_id, ASI.Assignment_id, ASI.Assignment_date, ASI.Assignment_title, ASI.Assignment_description, ASS.status_description FROM Accounts A JOIN Accounts_Assignment AA ON A.Account_id = AA.Account_id JOIN Assignments ASI ON ASI.Assignment_id = AA.Assignment_id JOIN Assignment_Status ASS ON ASS.status_id = ASI.Assignment_status_id where A.Account_id = '$user_ID' AND ASI.Assignment_status_id = 1 ORDER BY ASI.Assignment_date";
$result = mysqli_query($conn, $sql);

$numberOfRows = mysqli_num_rows($result);


?>

<button type="submit" class="btn btn-primary" style="margin-left: 10px"><a data-toggle="modal" data-target="#addNewModal" style="color: white" href="AddToDo.html">Add new assignment</a> </button>

<table class="table" style="width: 94rem; margin: 10px; overflow: hidden;">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Date</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Status <span class="badge badge-danger"><?php echo "$numberOfRows";?></span></th>
        <th scope="col">Modification</th>

    </tr>
    </thead>
    <tbody>
    <?php
    while($row = mysqli_fetch_array($result)){ ?>
            <tr id="<?php echo $row["Assignment_id"]?>">
                <td data-target="date" ><?php echo $row["Assignment_date"]?></td>
                <td data-target="title"><?php echo $row["Assignment_title"]?></td>
                <td data-target="description"><?php echo $row["Assignment_description"]?></td>
                <td data-target="status"><?php echo $row["status_description"]?></td>
            <td> 
            <button type="button" class="btn btn-success"><a data-role="update" data-id="<?php echo $row["Assignment_id"]?>"  style="color: white" href="#">Edit</a> </button>
            <button type="button" class="btn btn-danger"><a href="delete.php?assignment_id=<?php echo $row["Assignment_id"]?>" style="color: white" href="#">Delete</a></button>
            <button type="button" class="btn btn-warning"><a href="complete.php?assignment_id=<?php echo $row["Assignment_id"]?>" style="color: white" href="#">Complete</a></button>
            </td> 
        </tr>
    <?php  }
    ?>
    </tbody>
</table>

<!--Table for Assignment "Complete"-->
<?php


$sql = "SELECT A.Account_id, ASI.Assignment_id, ASI.Assignment_date, ASI.Assignment_title, ASI.Assignment_description, ASS.status_description FROM Accounts A JOIN Accounts_Assignment AA ON A.Account_id = AA.Account_id JOIN Assignments ASI ON ASI.Assignment_id = AA.Assignment_id JOIN Assignment_Status ASS ON ASS.status_id = ASI.Assignment_status_id where A.Account_id = '$user_ID' AND ASI.Assignment_status_id = 2 ORDER BY ASI.Assignment_date";
$result = mysqli_query($conn, $sql);

$numberOfRows = mysqli_num_rows($result);

?>
<table class="table" style="width: 94rem; margin: 10px;">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Date</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Status <span class="badge badge-danger"><?php echo "$numberOfRows";?></span></th>
        <th scope="col">Modification</th>
    </tr>
    </thead>
    <tbody>
    <?php
    while($row = mysqli_fetch_array($result)){ ?>
              <tr id="<?php echo $row["Assignment_id"]?>">
                  <td data-target="date" ><?php echo $row["Assignment_date"]?></td>
                  <td data-target="title"><?php echo $row["Assignment_title"]?></td>
                  <td data-target="description"><?php echo $row["Assignment_description"]?></td>
                  <td data-target="status"><?php echo $row["status_description"]?></td>
              <td>
                  <button type="button" class="btn btn-success"><a data-role="update" data-id="<?php echo $row["Assignment_id"]?>"  style="color: white" href="#">Edit</a> </button>
                  <button type="button" class="btn btn-danger"><a href="delete.php?assignment_id=<?php echo $row["Assignment_id"]?>" style="color: white" href="#">Delete</a></button>
                  <button type="button" class="btn btn-warning"><a href="toDo.php?assignment_id=<?php echo $row["Assignment_id"]?>" style="color: white" href="#">To-Do</a></button>
              </td>
              </tr>
    <?php }
    ?>
    </tbody>
</table>
<!--Modal for edit button-->
<!-- Modal -->
<form action="edit.php" method="POST">
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit: </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="text" id="date" name="date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Title</label>
                    <textarea type="text" id="description" name="description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <input type="hidden" id="Assignment_id" name="Assignment_id" class="form-control">
                    <input type="hidden" id="user_id" name="user_id" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" onclick="return validateEdit()" class="btn btn-primary">Update</button>
            </div>
        </div>

    </div>
</div>
</form>

<form action="addToDo.php" method="POST">
    <div id="addNewModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                <div class="form-group">
                    <h3>Add new assignment</h3>
                    <label for="date">Date</label>
                    <input type="text" class="form-control" id="dateNew" name="date" placeholder="YYYY-MM-DD">
                </div>
                <div class="form-group">
                    <label for="title">Assignment title</label>
                    <input type="text" class="form-control" id="titleNew" name="title">
                </div>
                    <div class="form-group">
                        <label for="description">Assignment description</label>
                        <textarea type="text" class="form-control" id="descriptionNew" name="description" maxlength="144"></textarea>

                    </div>
                </div>
                <div class="modal-footer">
                <button type="submit" onclick="return validateNew()" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
        </div>
    </div>
</form>


</body>
</html>

