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
    header("Location:index.php");
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
<div class="container-fluid" style="margin-top:10px">

<form action="AddSchools.php" method= "POST">
  <div class="form-group" style="width:50%">

  School name:<input class="form-control" type="text" name="Schoolname"><br>
  Teacher name:<input class="form-control" type="text" name="Teachername"><br>
  User name:<input class="form-control" type="text" name="Username"><br>
  Password:<input class="form-control" type="password" name="Pword"><br>

  <input class="btn btn-primary mb-2" type="submit" value="Add School">
</form>
</div>
<h3>Registered schools and staff</h3>
<?php
include_once ("connect.php");
$stmt = $conn->prepare("SELECT * FROM Schools ORDER BY Schoolname Asc" );
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    //make into table at some point
    echo($row["Schoolname"].' - '.$row["Teachername"]."<br>");
}
$conn=null;
?>

</select>
<br>

</div>
</body>
</html>
