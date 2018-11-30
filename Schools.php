<?php
session_start();
include_once ("connect.php");
$stmt = $conn->prepare("SELECT * FROM Schools" );
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  //checks if row exists in database
if($row) {
  if (!isset($_SESSION['name']))
  {
      header("Location:login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
  }

}
}

?>
<!DOCTYPE html>
<html>
<head>

    <title>Schools</title>

</head>
<body>
<form action="AddSchools.php" method= "POST">
  School name:<input type="text" name="Schoolname"><br>
  User name:<input type="text" name="Username"><br>
  Password:<input type="password" name="Pword"><br>

  <input type="submit" value="Add School">
</form>
<?php
include_once ("connect.php");
$stmt = $conn->prepare("SELECT * FROM Schools" );
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    //make into table at some point
    echo($row["SchoolID"].','.$row["Schoolname"].",".$row["Username"]."<br>");
}
$conn=null;
?>

</select>
<br>

</body>
</html>
