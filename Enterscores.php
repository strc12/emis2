<?php

session_start();
//boo
if (!isset($_SESSION['name']))
{
    header("Location:login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
}

?>
<?php
echo($_SESSION["fid"]);
include_once ("connect.php");
$stmt=$conn->prepare("SELECT Fixtures.FixtDate, 
Fixtures.M1H1,Fixtures.M1A1,
Fixtures.M2H1,Fixtures.M2A1,
Fixtures.M3H1,Fixtures.M3A1,Fixtures.M3H2,Fixtures.M3A2,
Fixtures.M4H1,Fixtures.M4A1,Fixtures.M4H2,Fixtures.M4A2,
Fixtures.M5H1,Fixtures.M5A1,Fixtures.M5H2,Fixtures.M5A2,
Fixtures.M6H1,Fixtures.M6A1,Fixtures.M6H2,Fixtures.M6A2,
Fixtures.M7H1,Fixtures.M7A1,Fixtures.M7H2,Fixtures.M7A2,
Fixtures.M8H1,Fixtures.M8A1,Fixtures.M8H2,Fixtures.M8A2,
Fixtures.M9H1,Fixtures.M9A1,Fixtures.M9H2,Fixtures.M9A2,
Fixtures.M10H1,Fixtures.M10A1,Fixtures.M10H2,Fixtures.M10A2,
Fixtures.HomeID as Home, Fixtures.AwayID as Away,  
M1.Forename as M1f, M1.Surname as M1s, 
M2.Forename as M2f, M2.Surname as M2s,
M3.Forename as M3f, M3.Surname as M3s,
L1.Forename as L1f, L1.Surname as L1s,
L2.Forename as L2f, L2.Surname as L2s,
L3.Forename as L3f, L3.Surname as L3s,
AM1.Forename as AM1f, AM1.Surname as AM1s, 
AM2.Forename as AM2f, AM2.Surname as AM2s,
AM3.Forename as AM3f, AM3.Surname as AM3s,
AL1.Forename as AL1f, AL1.Surname as AL1s,
AL2.Forename as AL2f, AL2.Surname as AL2s,
AL3.Forename as AL3f, AL3.Surname as AL3s,
awsc.Schoolname as AWS, hsch.Schoolname as HS, 
home.Division as hd, away.Division as ad
FROM Fixtures 
INNER JOIN  Players as M1 on HM1ID = M1.UserID
INNER JOIN  Players as M2 on HM2ID = M2.UserID
INNER JOIN  Players as M3 on HM3ID = M3.UserID
INNER JOIN  Players as L1 on HL1ID = L1.UserID
INNER JOIN  Players as L2 on HL2ID = L2.UserID
INNER JOIN  Players as L3 on HL3ID = L3.UserID
INNER JOIN  Players as AM1 on AM1ID = AM1.UserID
INNER JOIN  Players as AM2 on AM2ID = AM2.UserID
INNER JOIN  Players as AM3 on AM3ID = AM3.UserID
INNER JOIN  Players as AL1 on AL1ID = AL1.UserID
INNER JOIN  Players as AL2 on AL2ID = AL2.UserID
INNER JOIN  Players as AL3 on AL3ID = AL3.UserID
INNER JOIN Teams as home ON (Fixtures.HomeID = home.teamID) 
INNER JOIN  Teams as away ON (Fixtures.AwayID=away.TeamID) 
INNER JOIN Schools as awsc ON away.SchoolID=awsc.SchoolID 
INNER JOIN Schools as hsch ON home.SchoolID=hsch.SchoolID 
WHERE Fixtures.FixtureID=:id" );
$stmt->bindParam(':id', $_SESSION['fid']);
$stmt->execute();
//$stmt=$conn->prepare("SELECT FixtureID,HomeID, AwayID, fixtdate,home.teamID as HT, hsch.schoolID as HSID, awsc.schoolID as ASID,
//awsc.Schoolname as AWS, hsch.Schoolname as HS, home.Division as hd, away.Division as ad FROM Fixtures 
//INNER JOIN Teams as home ON (Fixtures.HomeID = home.teamID) 
//INNER JOIN  Teams as away ON (Fixtures.AwayID=away.TeamID) 
//INNER JOIN Schools as awsc ON away.SchoolID=awsc.SchoolID 
//INNER JOIN Schools as hsch ON home.SchoolID=hsch.SchoolID 
//WHERE fixtures.FixtureID=:id");
//$stmt->bindParam(':id', $_SESSION['fid']);
//$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE HTML>
<HTML>
<Head>
    <title>Enter scores</title>
</Head>
<Body>
<h3>Scores</h3>
<form action ="confirmresults.php" method="POST">
<table style = "width:60%" class="table-striped table-bordered table-condensed">
<tr>
<th rowspan="2">Match No.</th>
<th rowspan="2"><?php echo $row['HS']." ".$row['hd'];?></th>
<th rowspan="2"> </th>
<th rowspan="2"><?php echo $row['AWS']." ".$row['ad'];?></th>
<th colspan = "2">Points</th>
<th colspan="2">Games</th>
</tr>

<tr>
<td><?php echo $row['HS'];?></td>
<td><?php echo $row['AWS'];?></td>
<td><?php echo $row['HS'];?></td>
<td><?php echo $row['AWS'];?></td>
</tr>

<tr>
<td>1</td>
<td><?php echo $row['L1f']." ".$row['L1s'];?></td>
<td>v</td>
<td><?php echo $row['AL1f']." ".$row['AL1s'];?></td>
<td><input type="text" name="point1-h1"></td>
<td><input type="text" name="point1-a1"></td>
<td></td>
<td></td>
</tr>

<tr>
<td>2</td>
<td><?php echo $row['M1f']." ".$row['M1s'];?></td>
<td>v</td>
<td><?php echo $row['AM1f']." ".$row['AM1s'];?></td>
<td><input type="text" name="point2-h1"></td>
<td><input type="text" name="point2-a1"></td>
<td></td>
<td></td>
</tr>

<tr>
<td rowspan="2">3</td>
<td rowspan="2"><?php echo $row['M2f']." ".$row['M2s']." & ",$row['M3f']." ".$row['M3s'];?></td>
<td rowspan="2">v</td>
<td rowspan="2"><?php echo $row['AM2f']." ".$row['AM2s']." & ",$row['AM3f']." ".$row['AM3s'];?></td>
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
<td rowspan="2"><?php echo $row['L2f']." ".$row['L2s']." & ",$row['L3f']." ".$row['L3s'];?></td>
<td rowspan="2">v</td>
<td rowspan="2"><?php echo $row['AL2f']." ".$row['AL2s']." & ",$row['AL3f']." ".$row['AL3s'];?></td>
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
<td rowspan="2"><?php echo $row['M1f']." ".$row['M1s']." & ",$row['M2f']." ".$row['M2s'];?></td>
<td rowspan="2">v</td>
<td rowspan="2"><?php echo $row['AM1f']." ".$row['AM1s']." & ",$row['AM2f']." ".$row['AM2s'];?></td>
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
<td rowspan="2"><?php echo $row['L1f']." ".$row['L1s']." & ",$row['L2f']." ".$row['L2s'];?></td>
<td rowspan="2">v</td>
<td rowspan="2"><?php echo $row['AL1f']." ".$row['AL1s']." & ",$row['AL2f']." ".$row['AL2s'];?></td>
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
<td rowspan="2"><?php echo $row['L3f']." ".$row['L3s']." & ",$row['M3f']." ".$row['M3s'];?></td>
<td rowspan="2">v</td>
<td rowspan="2"><?php echo $row['AL3f']." ".$row['AL3s']." & ",$row['AM3f']." ".$row['AM3s'];?></td>
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
<td rowspan="2"><?php echo $row['L1f']." ".$row['L1s']." & ",$row['M1f']." ".$row['M1s'];?></td>
<td rowspan="2">v</td>
<td rowspan="2"><?php echo $row['AL1f']." ".$row['AL1s']." & ",$row['AM1f']." ".$row['AM1s'];?></td>
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
<td rowspan="2"><?php echo $row['L3f']." ".$row['L3s']." & ",$row['M2f']." ".$row['M2s'];?></td>
<td rowspan="2">v</td>
<td rowspan="2"><?php echo $row['AL3f']." ".$row['AL3s']." & ",$row['AM2f']." ".$row['AM2s'];?></td>
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
<td rowspan="2"><?php echo $row['L2f']." ".$row['L2s']." & ",$row['M3f']." ".$row['M3s'];?></td>
<td rowspan="2">v</td>
<td rowspan="2"><?php echo $row['AL2f']." ".$row['AL2s']." & ",$row['AM3f']." ".$row['AM3s'];?></td>
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