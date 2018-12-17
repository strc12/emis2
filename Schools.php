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

    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script>
  $(function() {
    $("#navigation").load("navbar.php");
    });
</script>
</head>
<body>
<div id="navigation"></div>
<div class="container-fluid" style="margin-top:80px">
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
</div>
</body>
</html>
