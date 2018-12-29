<?php
      session_start();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="shortcut icon" href="images/favicon.ico">
</head>
<body>

<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
  <ul class="nav navbar-nav">
  <li ">
    <a class="nav-link" href="Results.php">View Results</a>
  </li>
  <li>
    <a class="nav-link" href="Statistics.php">View Stats</a>
  </li>
  <li>
    <a class="nav-link" href="Tables.php">View Tables</a>
  </li>
  <li>
    <a class="nav-link" href="Legacy.php">Pre2019 tables</a>
  </li>
  <?php
  if(isset($_SESSION['name'])){
    echo('<li >
    <a class="nav-link text-warning" href="Players.php">Add Players</a>
    </li>
    <li >
      <a class="nav-link text-warning" href="fixtures.php">Add Fixture dates</a>
    </li>
    <li >
      <a class="nav-link text-warning" href="Enterresults.php">Add results</a>
    </li>
    <li >
      <a class="nav-link text-warning" href="Manageplayers.php">Manage players</a>
    </li>');

  if($_SESSION['name']=='ric'){
    echo('
    <li>
      <a class="nav-link text-danger" href="seasonsetup.php">New Season</a>
    </li>
    <li>
      <a class="nav-link text-danger" href="Schools.php">Add Schools</a>
    </li>
    
    <li>
      <a class="nav-link text-danger" href="Teams.php">Add Teams</a>
    </li>');
    }
  }
  ?>

</ul>
<ul class="nav navbar-nav ml-auto navbar-right">
<?php
if(isset($_SESSION['name'])){
echo('<li>
<a class="nav-link" href="#">Hi '.$_SESSION['Teachername'].'</a>
</li> 
<li>
<a class="nav-link" href="logout.php">Logout</a>
</li>');
}else{
echo('<form class="form-inline" action="loginprocess.php" method="post">');
echo '<input type="hidden" name="location" value="';
//handles redirect to referring page
if(isset($_GET['location'])) {
    echo htmlspecialchars($_GET['location']);
}else{echo("index.php");}
echo '" />';
echo('<input class="form-control mr-sm-2" name="Username" type="text" placeholder="Username">
<input class="form-control mr-sm-2" name="Pword" type="password" placeholder="Password">
<button class="btn btn-success" type="submit">Login</button></form>');
}

?>
</ul>
</div>
</nav>


  
      <!--JavaScript at end of body for optimized loading-->
    
    </body>
  </html>
