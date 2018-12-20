<?php
session_start();

if (!isset($_SESSION['name']))
{
    header("Location:index.php");
    //header("Location:login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
    //sends referring page as get to login page for correct redirection afterwards
}
?>
<!DOCTYPE html>
<html>
<head>

    <title>Teams</title>

    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="shortcut icon" href="images/favicon.ico">
  <script>
  $(function() {
    $("#navigation").load("navbar.php");
    });
</script>
</head>
<body>
<div id="navigation"></div>
<div class="container-fluid" style="margin-top:10px">


<form action="Addteam.php" method="POST">
<div class="form-group" style="width:30%">
    School:<select class="form-control" name="SchoolID">
    <?php
        include_once ("connect.php");
        $stmt = $conn->prepare("SELECT * FROM Schools" );
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo("<option value=".$row["SchoolID"].'>'.$row["Schoolname"]."</option>");
        }
        //$conn=null;
        ?>

        </select>
        <br>
    <div class="radio">
        <label><input type="radio" name="division" value="A" checked>A team</label>
    </div>
    <div class="radio">
        <label><input type="radio" name="division" value="B">B team</label>
    </div>




     <input class="btn btn-primary mb-2" type="submit" value="Add Team">
</div>
</form>
<br>
<?php

$stmt = $conn->prepare("SELECT Teams.Teamid, Schools.Schoolname, Teams.Division, Teams.SchoolID FROM Teams INNER JOIN Schools ON Teams.SchoolID = Schools.SchoolID" );
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    //make into table at some point
    echo($row["Schoolname"]." ".$row["Division"]."<br>");
}
$conn=null;
?>
</div>
</body>
</html>
