
<?php 
if(session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}
include "setseason.php";
?>
<!DOCTYPE html>
<html>
<head>

    <title>EMIS Badminton</title>

    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <link rel="shortcut icon" href="images/favicon.ico">  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  
  <script>
  $(function() {
    $("#navigation").load("navbar.php");
    });
</script>
</head>
<body>
<div id="navigation"></div>
<div class="jumbotron jumbotron-fluid">
  <div class="container" style="text-align:center">
    <h1>EMIS BADMINTON</h1> 
    <h2>New site for Sept 2024</h2>
    
  </div>
</div>
<div class="container text-center">
  <h3>The Schools</h3>
  <p><em>We love Badminton!</em></p>
  <br>
  <div class="row">
    <div class="col-sm-3">
      <p><strong>Stamford</strong></p><br>
      <img class="img-fluid" src="images/stamford.jpg" alt="Stamford">
    </div>
    <div class="col-sm-3">
      <p><strong>Oakham</strong></p><br>
      <img class="img-fluid" src="images/Oakham.jpg" alt="Oakham">
    </div>
    <div class="col-sm-3">
      <p><strong>Uppingham</strong></p><br>
      <img class="img-fluid" src="images/Uppingham.png" alt="Uppingham">
    </div>
    <div class="col-sm-3">
      <p><strong>Oundle</strong></p><br>
      <img class="img-fluid" src="images/Oundle.png" alt="Oundle">
    </div>
  </div>
</div>
</body>
</html>
