<?php
session_start();

if (!isset($_SESSION['name']))
{
    header("Location:login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
    //sends referring page as get to login page for correct redirection afterwards
}
?>
<!DOCTYPE html>
<html>
<head>

    <title>Fixtures</title>

</head>
<body>


<form action="Addfixtures.php" method="POST">
Home Team:<select name="HomeID">
  <?php
include_once ("connect.php");
$stmt = $conn->prepare("SELECT teams.Teamid, schools.Schoolname, teams.Division, teams.SchoolID FROM teams 
INNER JOIN schools ON teams.SchoolID = schools.SchoolID" );
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    echo("<option value=".$row["Teamid"].'>'.$row["Schoolname"].$row["Division"]."</option>");
}
//$conn=null;
?>

</select>
<br>
Away Team:<select name="AwayID">
  <?php
include_once ("connect.php");
$stmt = $conn->prepare("SELECT Teams.Teamid, Schools.Schoolname, Teams.Division, Teams.SchoolID FROM Teams 
INNER JOIN Schools ON Teams.SchoolID = Schools.SchoolID" );
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    echo("<option value=".$row["Teamid"].'>'.$row["Schoolname"].$row["Division"]."</option>");
}
//$conn=null;
?>

</select>
<br>
Date <input type='date' id='datepicker' name='fixtdate' size='9' value=''>
  <br>


  <input type="submit" value="Add Fixture">
</form>
<?php
//include_once ("connect.php");
$stmt = $conn->prepare("SELECT FixtureID,HomeID, AwayID, fixtdate, 
awsc.Schoolname as AWS, hsch.Schoolname as HS, 
home.Division, away.Division FROM Fixtures 
INNER JOIN Teams as home ON (Fixtures.HomeID = home.teamID) 
INNER JOIN  Teams as away ON (Fixtures.AwayID=away.TeamID) 
INNER JOIN Schools as awsc ON away.SchoolID=awsc.SchoolID 
INNER JOIN Schools as hsch ON home.SchoolID=hsch.SchoolID 
ORDER BY fixtdate ASC" );
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    //make into table at some point
    echo($row["FixtureID"].' - '.$row["HS"].$row["Division"]." v ".$row["AWS"].$row["Division"]." - ".$row["fixtdate"]."<br>");
}
$conn=null;
?>

</body>
</html>
