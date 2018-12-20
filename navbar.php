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
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto"
      
      <li class="nav-item">
        <a class="nav-link" href="Results.php">View Results</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Statistics.php">View Stats</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Tables.php">View Tables</a>
      </li>
      <?php
      session_start();
      if(isset($_SESSION['name'])){
        echo('<li class="nav-item">
        <a class="nav-link text-warning" href="Players.php">Add Players</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-warning" href="fixtures.php#">Add Fixtures</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-warning" href="Enterresults.php">Add results</a>
        </li>');
     
      if($_SESSION['name']=='ric'){
        echo('
        <li class="nav-item">
          <a class="nav-link text-danger" href="Schools.php">Add Schools</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link text-danger" href="Teams.php">Add Teams</a>
        </li>');
        }
      }
      ?>
      </ul>
    </div>
     <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
     <ul class="navbar-nav ml-auto">
      <?php
      if(isset($_SESSION['name'])){
      echo('<li class="nav-item">
        <a class="nav-link" href="#">Hi '.$_SESSION['Teachername'].'</a>
        </li> 
      <li class="nav-item">
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
