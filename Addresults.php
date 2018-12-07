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
<style>
.table td.fit, 
.table th.fit {
    white-space: nowrap;
    width: 1%;
}
td,th{
    text-align:center;
}
</style>
</head>
<body>

<?php
$q = intval($_GET['q']);

echo ($q);
include_once ("connect.php");
$stmt=$conn->prepare("SELECT FixtureID,HomeID, AwayID, fixtdate,home.teamID as HT, hsch.schoolID as HSID, awsc.schoolID as ASID,
awsc.Schoolname as AWS, hsch.Schoolname as HS, home.Division as hd, away.Division as ad FROM Fixtures 
INNER JOIN Teams as home ON (Fixtures.HomeID = home.teamID) 
INNER JOIN  Teams as away ON (Fixtures.AwayID=away.TeamID) 
INNER JOIN Schools as awsc ON away.SchoolID=awsc.SchoolID 
INNER JOIN Schools as hsch ON home.SchoolID=hsch.SchoolID 
WHERE fixtures.FixtureID=:id");
$stmt->bindParam(':id', $q);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);
$home=$row["HSID"];
$away=$row["ASID"];
echo($home."<br>");
echo($away."<br>");


echo("<table style = 'width:50%'  class=' table-bordered table-condensed'><thead><th>Player</th><th>HOME</th><th>AWAY</th></thead><tr>");
$stmt2=$conn->prepare("SELECT players.Forename,players.Surname,players.UserID from players 
INNER JOIN schools ON schools.SchoolID=players.School 
Where schools.SchoolID=:School AND players.Gender='M'");
$stmt2->bindParam(':School', $home);
$stmt2->execute();
echo("<td>Man 1</td><td style = 'width:100%'> <select name='M1H1' >");
while ($row = $stmt2->fetch(PDO::FETCH_ASSOC))
{
    echo("<option value=".$row["UserID"].'>'.$row["Forename"]." ".$row["Surname"]."</option>");
}
echo("</select></td><td style = 'width:100%'>");
$stmt2=$conn->prepare("SELECT players.Forename,players.Surname,players.UserID from players 
INNER JOIN schools ON schools.SchoolID=players.School 
Where schools.SchoolID=:School AND players.Gender='M'");
$stmt2->bindParam(':School', $away);
$stmt2->execute();
echo("<select name='M1A1'>");
while ($row = $stmt2->fetch(PDO::FETCH_ASSOC))
{
    echo("<option value=".$row["UserID"].'>'.$row["Forename"]." ".$row["Surname"]."</option>");
}
echo("</select></td>");
?>
<form action ="confirmresults.php" method="POST">
<br><br><h3>Players</h3><table style = "width:60%"  class="table-striped table-bordered table-condensed"><tr><th colspan="2">Home Players</th><th colspan="2">Away Players</th></tr>
    <tr>
    <td>Man 1</td>
    <td><select name = 'homeman1'><option value = '' selected disabled>Please select a player...</option>NO PLAYERS!</select></td>
    <td>Man 1</td>
    <td><select name = 'awayman1'><option value = '' selected disabled>Please select a player...</option>NO PLAYERS!</select></td>
    </tr>

    <tr>
    <td>Man 2</td>
    <td><select name = 'homeman2'><option value = '' selected disabled>Please select a player...</option>NO PLAYERS!</select></td>
    <td>Man 2</td>
    <td><select name = 'awayman2'><option value = '' selected disabled>Please select a player...</option>NO PLAYERS!</select></td>
    </tr>

    <tr>
    <td>Man 3</td>
    <td><select name = 'homeman3'><option value = '' selected disabled>Please select a player...</option>NO PLAYERS!</select></td>
    <td>Man 3</td>
    <td><select name = 'awayman3'><option value = '' selected disabled>Please select a player...</option>NO PLAYERS!</select></td>
    </tr>

    <tr>
    <td>Lady 1</td>
    <td><select name = 'homelady1'><option value = '' selected disabled>Please select a player...</option>NO PLAYERS!</select></td>
    <td>Lady 1</td>
    <td><select name = 'awaylady1'><option value = '' selected disabled>Please select a player...</option>NO PLAYERS!</select></td>
    </tr>

    <tr>
    <td>Lady 2</td>
    <td><select name = 'homelady2'><option value = '' selected disabled>Please select a player...</option>NO PLAYERS!</select></td>
    <td>Lady 2</td>
    <td><select name = 'awaylady2'><option value = '' selected disabled>Please select a player...</option>NO PLAYERS!</select></td>
    </tr>

    <tr>
    <td>Lady 3</td>
    <td><select name = 'homelady3'><option value = '' selected disabled>Please select a player...</option>NO PLAYERS!</select></td>
    <td>Lady 3</td>
    <td><select name = 'awaylady3'><option value = '' selected disabled>Please select a player...</option>NO PLAYERS!</select></td>
    </tr>
    </table>
    <br><br>
    <h3>Scores</h3>

    <table style = "width:60%" class="table-striped table-bordered table-condensed">
    <tr>
    <th rowspan="2">Match No.</th>
    <th rowspan="2"></th>
    <th rowspan="2"> </th>
    <th rowspan="2"></th>
    <th colspan = "2">Points</th>
    <th colspan="2">Games</th>
    </tr>

    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>

    <tr>
    <td>1</td>
    <td>L1</td>
    <td>v</td>
    <td>L1</td>
    <td><input type="text" name="point1-h1"></td>
    <td><input type="text" name="point1-a1"></td>
    <td></td>
    <td></td>
    </tr>

    <tr>
    <td>2</td>
    <td>M1</td>
    <td>v</td>
    <td>M1</td>
    <td><input type="text" name="point2-h1"></td>
    <td><input type="text" name="point2-a1"></td>
    <td></td>
    <td></td>
    </tr>

    <tr>
    <td rowspan="2">3</td>
    <td rowspan="2">M2+M3</td>
    <td rowspan="2">v</td>
    <td rowspan="2">M2+M3</td>
    <td><input type="text" name="point3-h1"></td>
    <td><input type="text" name="point3-a1"></td>
    <td></td>
    <td></td>
    </tr>

    <tr>
    <td><input type="text" name="point3-h2"></td>
    <td><input type="text" name="point3-a2"></td>
    <td></td>
    <td></td>
    </tr>

    <tr>
    <td rowspan="2">4</td>
    <td rowspan="2">L2+L3</td>
    <td rowspan="2">v</td>
    <td rowspan="2">L2+L3</td>
    <td><input type="text" name="point4-h1"></td>
    <td><input type="text" name="point4-a1"></td>
    <td></td>
    <td></td>
    </tr>

    <tr>
    <td><input type="text" name="point4-h2"></td>
    <td><input type="text" name="point4-a2"></td>
    <td></td>
    <td></td>
    </tr>

    <tr>
    <td rowspan="2">5</td>
    <td rowspan="2">M1+M2</td>
    <td rowspan="2">v</td>
    <td rowspan="2">M1+M2</td>
    <td><input type="text" name="point5-h1"></td>
    <td><input type="text" name="point5-a1"></td>
    <td></td>
    <td></td>
    </tr>

    <tr>
    <td><input type="text" name="point5-h2"></td>
    <td><input type="text" name="point5-a2"></td>
    <td></td>
    <td></td>
    </tr>

    <tr>
    <td rowspan="2">6</td>
    <td rowspan="2">L1+L2</td>
    <td rowspan="2">v</td>
    <td rowspan="2">L1+L2</td>
    <td><input type="text" name="point6-h1"></td>
    <td><input type="text" name="point6-a1"></td>
    <td></td>
    <td></td>
    </tr>

    <tr>
    <td><input type="text" name="point6-h2"></td>
    <td><input type="text" name="point6-a2"></td>
    <td></td>
    <td></td>
    </tr>

    <tr>
    <td rowspan="2">7</td>
    <td rowspan="2">L3+M3</td>
    <td rowspan="2">v</td>
    <td rowspan="2">L3+M3</td>
    <td><input type="text" name="point7-h1"></td>
    <td><input type="text" name="point7-a1"></td>
    <td></td>
    <td></td>
    </tr>

    <tr>
    <td><input type="text" name="point7-h2"></td>
    <td><input type="text" name="point7-a2"></td>
    <td></td>
    <td></td>
    </tr>

    <tr>
    <td rowspan="2">8</td>
    <td rowspan="2">L1+M1</td>
    <td rowspan="2">v</td>
    <td rowspan="2">L1+M1</td>
    <td><input type="text" name="point8-h1"></td>
    <td><input type="text" name="point8-a1"></td>
    <td></td>
    <td></td>
    </tr>

    <tr>
    <td><input type="text" name="point8-h2"></td>
    <td><input type="text" name="point8-a2"></td>
    <td></td>
    <td></td>
    </tr>

    <tr>
    <td rowspan="2">9</td>
    <td rowspan="2">L3+M2</td>
    <td rowspan="2">v</td>
    <td rowspan="2">L3+M2</td>
    <td><input type="text" name="point9-h1"></td>
    <td><input type="text" name="point9-a1"></td>
    <td></td>
    <td></td>
    </tr>

    <tr>
    <td><input type="text" name="point9-h2"></td>
    <td><input type="text" name="point9-a2"></td>
    <td></td>
    <td></td>
    </tr>

    <tr>
    <td rowspan="2">10</td>
    <td rowspan="2">L2+M3</td>
    <td rowspan="2">v</td>
    <td rowspan="2">L2+M3</td>
    <td><input type="text" name="point10-h1"></td>
    <td><input type="text" name="point10-a1"></td>
    <td></td>
    <td></td>
    </tr>

    <tr>
    <td><input type="text" name="point10-h2"></td>
    <td><input type="text" name="point10-a2"></td>
    <td></td>
    <td></td>
    </tr>
    </table>

    <input type="submit" value="Submit" name="inputresult">



    </form>

</body>
</html>