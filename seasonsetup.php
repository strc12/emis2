<?php
session_start();

if (!isset($_SESSION['name']))
{
    header("Location:index.php");
    //sends referring page as get to login page for correct redirection afterwards
}
include "setseason.php";
?>
<!DOCTYPE html>
<html>
<head>

    <title>Season Setup</title>
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
<div class="container-fluid" style="margin-top:10px ">
    <h2>SEASON SETUP - Do at beginning of season only</h2>
    <form action="Addnewseason.php" method="POST">
    <input class="form-control"  style="width:30%" type="text" value="ENTER NEW SEASON CODE" name="season">
    <br>
    <input class="btn btn-primary mb-2" type="submit" value="Setup Season">
</form>

</div>
</body>
</html>
