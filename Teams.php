<?php
session_start();

if (!isset($_SESSION['name']))
{
    header("Location:login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
    //sends referring page as get to login page for correct redirection afterwards
}
?>
<!DOCTYPE html>
<html>
<head>

    <title>Teams</title>

</head>
<body>


<form action="Addteam.php" method="POST">
School:<select name="SchoolID">
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
  <!--Creates a drop down list-->
  Gender:<br>
  <input type="radio" name="division" value="A" checked> A team<br>
  <input type="radio" name="division" value="B"> B Team<br>
  <br>


  <input type="submit" value="Add Team">
</form>
<?php

$stmt = $conn->prepare("SELECT Teams.Teamid, Schools.Schoolname, Teams.Division, Teams.SchoolID FROM Teams INNER JOIN Schools ON Teams.SchoolID = Schools.SchoolID" );
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    //make into table at some point
    echo($row["SchoolID"].','.$row["Schoolname"].",".$row["Division"]."<br>");
}
$conn=null;
?>

</body>
</html>
