<!DOCTYPE html>
<html>
<head>
<title>Results</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="shortcut icon" href="images/favicon.ico">
</head>
<body>
<form  nam="bob" action="updatestatus.php" method="POST">
  <table style = 'width:30%'  class='table table-striped table-bordered' role='grid'>
    <thead>
    <tr><th>Name</th><th>Active</th></tr>
    
    </thead>
    <tbody>
    
    
    <?php
    include_once ("connect.php");
      $q = intval($_GET['q']);
      $stmt = $conn->prepare("SELECT Schoolname FROM  schools  WHERE SchoolID=".$q );
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $School=$row["Schoolname"];
      echo("<h3>".$School." players</h3>");
      $stmt1 = $conn->prepare("SELECT Forename, Surname, UserID, Schoolname, Active FROM players INNER JOIN schools ON players.School=schools.SchoolID WHERE School=:fid ORDER BY Active DESC,Surname ASC ");
      $stmt1->bindParam(':fid', $q);
      $stmt1->execute();
      while ($row = $stmt1->fetch(PDO::FETCH_ASSOC))
      {
        if($row["Active"]==1){
            echo("<input type='hidden' name='".$row['UserID']."' value='0'>");
            echo("<tr><td>".$row['Forename']." ".$row['Surname']."</td><td><input name='".$row['UserID']."'type='checkbox' value='1' checked></td></tr>");
        }else{
            echo("<input type='hidden' name='".$row['UserID']."' value='0'>");
            echo("<tr><td>".$row['Forename']." ".$row['Surname']."</td><td><input name='".$row['UserID']."'type='checkbox' value='1' ></td></tr>");
        }
      }
  
    ?>
    </tbody>
    <input class="btn btn-primary mb-2" type="submit" value="Update players"> 
</table>
</form>
</body>
</html>