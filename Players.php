<?php
session_start();

if (!isset($_SESSION['name']))
{
  header("Location:index.php");
}
?>
<!DOCTYPE html>
<html>
<head>

    <title>Players</title>

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
<form action="Addplayer.php" method="POST">
  <div class="form-group" style="width:50%">
    First name:<input autocomplete="off"  class="form-control"  type="text" name="forename"><br>
    Last name:<input autocomplete="off" class="form-control" type="text" name="surname"><br>
    <!--Creates a drop down list-->
    Gender:<select class="form-control"  name="gender">
      <option value="M">Male</option>
      <option value="F">Female</option>
    </select>
    <br>
    School:<select class="form-control"  name="SchoolID">
    <?php
    echo ($_SESSION["SchoolID"]);
      include_once ("connect.php");
      $stmt = $conn->prepare("SELECT * FROM schools" );
      $stmt->execute();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        if($_SESSION["SchoolID"]==$row["SchoolID"] && ($row["Schoolname"]!="admin")){
          echo("<option selected='selected' value=".$row["SchoolID"].'>'.$row["Schoolname"]."</option>");
        }else if ($row["Schoolname"]!="admin"){
          echo("<option value=".$row["SchoolID"].'>'.$row["Schoolname"]."</option>");
        }
      }
      
    ?>

    </select>
    </div>
  <input class="btn btn-primary mb-2" type="submit" value="Add Player">
  
</form>

<div class="container text-center">
  <h3>The Players</h3>
  <br>
  <div class="row">
  <?php 
    $stmt = $conn->prepare("SELECT * FROM schools ORDER BY Schoolname Asc" );
    $stmt->execute();
    $count=$stmt->rowCount();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        //make into table at some point
        
      $schID=$row["SchoolID"];
      $sch=$row["Schoolname"];
      echo('<div class="col-sm-'.(12/$count).'">');
      if ($row["Schoolname"]!="admin"){
      echo("<p><strong>".$sch."</strong></p><br>");}
      

        $stmt2 = $conn->prepare("SELECT * FROM players WHERE School=".$schID." AND Active=1 ORDER BY Gender Asc,Surname ASC" );
        $stmt2->execute();
        while ($plyr = $stmt2->fetch(PDO::FETCH_ASSOC))
        {
          echo($plyr["Forename"].' '.$plyr["Surname"]."<br>");
        }

    
    echo("</div>");
    }
    ?>
    
  </div>
  
</div>

</div>
</body>
</html>
