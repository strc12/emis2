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


<form>
<label>Fixture: </label>
<select id="matches" onchange="showresult(this.value)">
    <option>Select match</option>
   <?php
   session_start();
   include "setseason.php";
   include_once ("connect.php");
   $stmt = $conn->prepare("SELECT FixtureID,HomeID, AwayID, Season, fixtdate, 
   awsc.Schoolname as AWS, hsch.Schoolname as HS, home.Division as hd, away.Division as ad FROM fixtures 
   INNER JOIN teams as home ON (fixtures.HomeID = home.teamID) 
   INNER JOIN teams as away ON (fixtures.AwayID=away.TeamID) 
   INNER JOIN schools as awsc ON away.SchoolID=awsc.SchoolID 
   INNER JOIN schools as hsch ON home.SchoolID=hsch.SchoolID 
   WHERE ScoresEntered=1 and Season=:SEAS ORDER BY fixtdate ASC " );


   $stmt->bindParam(':SEAS', $_SESSION["SEASON"]);
   $stmt->execute();
   
   while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
   {
       echo("<option value=".$row["FixtureID"].'>'.$row["HS"]." ".$row["hd"]." v ".$row["AWS"]." ".$row["ad"]." - ".date("d M y",(strtotime($row["fixtdate"])))."</option><br>");
   }
   $conn=null;
   ?>
    
    
</select>
</form>


</body>
</html>