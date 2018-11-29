<?php
session_start();

if (!isset($_SESSION['name']))
{
    header("Location:login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
}
?>
<!DOCTYPE html>
<html>
<head>
    
    <title>Players</title>
    
</head>
<body>
<form action="Addplayer.php" method="POST">
  First name:<input type="text" name="forename"><br>
  Last name:<input type="text" name="surname"><br>
  <!--Creates a drop down list-->
  Gender:<select name="gender">
		<option value="M">Male</option>
		<option value="F">Female</option>
	</select>
  <br>
  School:<select name="SchoolID">
  <?php
include_once ("connect.php");
$stmt = $conn->prepare("SELECT * FROM schools" );
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    echo("<option value=".$row["SchoolID"].'>'.$row["Schoolname"]."</option>");
}
$conn=null;
?>

</select>
  
  <input type="submit" value="Add Player">
</form>


</body>
</html>       
