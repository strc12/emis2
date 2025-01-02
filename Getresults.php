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
<style>

td,th{
    text-align:center;
}
</style>
</head>
<body>

<?php
include ("setseason.php");
$q = intval($_GET['q']);



include_once ("connect.php");
$stmt = $conn->prepare("SELECT fixtures.FixtDate, 
fixtures.M1H1,fixtures.M1A1,
fixtures.M2H1,fixtures.M2A1,
fixtures.M3H1,fixtures.M3A1,fixtures.M3H2,fixtures.M3A2,
fixtures.M4H1,fixtures.M4A1,fixtures.M4H2,fixtures.M4A2,
fixtures.M5H1,fixtures.M5A1,fixtures.M5H2,fixtures.M5A2,
fixtures.M6H1,fixtures.M6A1,fixtures.M6H2,fixtures.M6A2,
fixtures.M7H1,fixtures.M7A1,fixtures.M7H2,fixtures.M7A2,
fixtures.M8H1,fixtures.M8A1,fixtures.M8H2,fixtures.M8A2,
fixtures.M9H1,fixtures.M9A1,fixtures.M9H2,fixtures.M9A2,
fixtures.M10H1,fixtures.M10A1,fixtures.M10H2,fixtures.M10A2,
fixtures.HomeID as Home, fixtures.AwayID as Away,  
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
home.Division, away.Division
FROM fixtures 
INNER JOIN  players as M1 on HM1ID = M1.UserID
INNER JOIN  players as M2 on HM2ID = M2.UserID
INNER JOIN  players as M3 on HM3ID = M3.UserID
INNER JOIN  players as L1 on HL1ID = L1.UserID
INNER JOIN  players as L2 on HL2ID = L2.UserID
INNER JOIN  players as L3 on HL3ID = L3.UserID
INNER JOIN  players as AM1 on AM1ID = AM1.UserID
INNER JOIN  players as AM2 on AM2ID = AM2.UserID
INNER JOIN  players as AM3 on AM3ID = AM3.UserID
INNER JOIN  players as AL1 on AL1ID = AL1.UserID
INNER JOIN  players as AL2 on AL2ID = AL2.UserID
INNER JOIN  players as AL3 on AL3ID = AL3.UserID
INNER JOIN teams as home ON (fixtures.HomeID = home.teamID) 
INNER JOIN teams as away ON (fixtures.AwayID=away.TeamID) 
INNER JOIN schools as awsc ON away.SchoolID=awsc.SchoolID 
INNER JOIN schools as hsch ON home.SchoolID=hsch.SchoolID 
WHERE fixtures.FixtureID=:fid " );
$stmt->bindParam(':fid', $q);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$Hometotal=$row["M1H1"]+$row["M2H1"]+$row["M3H1"]+$row["M3H2"]+$row["M4H1"]+$row["M4H2"]+$row["M5H1"]+$row["M5H2"]+$row["M6H1"]+$row["M6H2"]+$row["M7H1"]+$row["M7H2"]+$row["M8H1"]+$row["M8H2"]+$row["M9H1"]+$row["M9H2"]+$row["M10H1"]+$row["M10H2"];
$Awaytotal=$row["M1A1"]+$row["M2A1"]+$row["M3A1"]+$row["M3A2"]+$row["M4A1"]+$row["M4A2"]+$row["M5A1"]+$row["M5A2"]+$row["M6A1"]+$row["M6A2"]+$row["M7A1"]+$row["M7A2"]+$row["M8A1"]+$row["M8A2"]+$row["M9A1"]+$row["M9A2"]+$row["M10A1"]+$row["M10A2"];

$homegametotal=0;
$awaygametotal=0;
if($row["M1H1"] > $row["M1A1"]){
    $homegametotal+=1;
}else{
    $awaygametotal+=1;
}
if($row["M2H1"] > $row["M2A1"]){
    $homegametotal+=1;
}else{
    $awaygametotal+=1;
}
if($row["M3H1"] > $row["M3A1"]){
    $homegametotal+=1;
}else{
    $awaygametotal+=1;
}
if($row["M3H2"] > $row["M3A2"]){
    $homegametotal+=1;
}else{
    $awaygametotal+=1;
}
if($row["M4H1"] > $row["M4A1"]){
    $homegametotal+=1;
}else{
    $awaygametotal+=1;
}
if($row["M4H2"] > $row["M4A2"]){
    $homegametotal+=1;
}else{
    $awaygametotal+=1;
}
if($row["M5H1"] > $row["M5A1"]){
    $homegametotal+=1;
}else{
    $awaygametotal+=1;
}
if($row["M5H2"] > $row["M5A2"]){
    $homegametotal+=1;
}else{
    $awaygametotal+=1;
}
if($row["M6H1"] > $row["M6A1"]){
    $homegametotal+=1;
}else{
    $awaygametotal+=1;
}
if($row["M6H2"] > $row["M6A2"]){
    $homegametotal+=1;
}else{
    $awaygametotal+=1;
}
if($row["M7H1"] > $row["M7A1"]){
    $homegametotal+=1;
}else{
    $awaygametotal+=1;
}
if($row["M7H2"] > $row["M7A2"]){
    $homegametotal+=1;
}else{
    $awaygametotal+=1;
}
if($row["M8H1"] > $row["M8A1"]){
    $homegametotal+=1;
}else{
    $awaygametotal+=1;
}
if($row["M8H2"] > $row["M8A2"]){
    $homegametotal+=1;
}else{
    $awaygametotal+=1;
}
if($row["M9H1"] > $row["M9A1"]){
    $homegametotal+=1;
}else{
    $awaygametotal+=1;
}
if($row["M9H2"] > $row["M9A2"]){
    $homegametotal+=1;
}else{
    $awaygametotal+=1;
}
if($row["M10H1"] > $row["M10A1"]){
    $homegametotal+=1;
}else{
    $awaygametotal+=1;
}
if($row["M10H2"] > $row["M10A2"]){
    $homegametotal+=1;
}else{
    $awaygametotal+=1;
}

echo($row["FixtDate"]."<br>");
echo("<table style = 'width:60%'  class='table-bordered table-condensed'>");
echo("<thead class='thead-dark'></thead><tr><th colspan='3'></th><th>Home</th><th>Away</th><th></th><th></th></tr>");
echo("<tr><th colspan='3'></th><th>".$row["HS"]."</th><th>".$row["AWS"]."</th><th></th><th></th></tr></thead>");

echo("<tr></tr><td colspan='3'>Man1</td><td>".$row["M1f"]." ".$row["M1s"]."</td><td>".$row["AM1f"]." ".$row["AM1s"]."</td><td></td><td></td></tr>");
echo("<tr></tr><td colspan='3'>Man2</td><td>".$row["M2f"]." ".$row["M2s"]."</td><td>".$row["AM2f"]." ".$row["AM2s"]."</td><td></td><td></td></tr>");
echo("<tr></tr><td colspan='3'>Man3</td><td>".$row["M3f"]." ".$row["M3s"]."</td><td>".$row["AM3f"]." ".$row["AM3s"]."</td><td></td><td></td></tr>");
echo("<tr></tr><td colspan='3'>Lady1</td><td>".$row["L1f"]." ".$row["L1s"]."</td><td>".$row["AL1f"]." ".$row["AL1s"]."</td><td></td><td></td></tr>");
echo("<tr></tr><td colspan='3'>Lady2</td><td>".$row["L2f"]." ".$row["L2s"]."</td><td>".$row["AL2f"]." ".$row["AL2s"]."</td><td></td><td></td></tr>");
echo("<tr></tr><td colspan='3'>Lady3</td><td>".$row["L3f"]." ".$row["L3s"]."</td><td>".$row["AL3f"]." ".$row["AL3s"]."</td><td></td><td></td></tr>");
echo("<tr><td></td><td></td><td></td><td></td><td></td></tr>");
echo("<tr></tr><td>".$row["M1f"]."</td><td>v</td><td>".$row["AM1f"]."</td><td>".$row["M1H1"]."</td><td>".$row["M1A1"]."</td>
<td>".($row["M1H1"] > $row["M1A1"]?1:0)."<td>".($row["M1H1"] < $row["M1A1"]?1:0)."</td></tr>");
echo("<tr><td></td><td></td><td></td></tr>");
echo("<tr></tr><td>".$row["L1f"]."</td><td>v</td><td>".$row["AL1f"]."</td><td>".$row["M2H1"]."</td><td>".$row["M2A1"]."</td>
<td>".($row["M2H1"] > $row["M2A1"]?1:0)."<td>".($row["M2H1"] < $row["M2A1"]?1:0)."</td></tr>");
echo("<tr><td></td><td></td><td></td></tr>");

echo("<tr></tr><td rowspan='2'>".$row["M2f"]." and ".$row["M3f"]."</td><td rowspan='2'>v</td><td rowspan='2'>".$row["AM2f"]." and ".$row["AM3f"]."</td>
<td>".$row["M3H1"]."</td><td>".$row["M3A1"]."</td><td>".($row["M3H1"] > $row["M3A1"]?1:0)."</td><td>".($row["M3H1"] < $row["M3A1"]?1:0)."</td></tr>
<td>".$row["M3H2"]."</td><td>".$row["M3A2"]."</td><td>".($row["M3H2"] > $row["M3A2"]?1:0)."</td><td>".($row["M3H2"] < $row["M3A2"]?1:0)."</td></tr>");
echo("<tr><td></td><td></td><td></td></tr>");

echo("<tr></tr><td rowspan='2'>".$row["L2f"]." and ".$row["L3f"]."</td><td rowspan='2'>v</td><td rowspan='2'>".$row["AL2f"]." and ".$row["AL3f"]."</td>
<td>".$row["M4H1"]."</td><td>".$row["M4A1"]."</td><td>".($row["M4H1"] > $row["M4A1"]?1:0)."</td><td>".($row["M4H1"] < $row["M4A1"]?1:0)."</td></tr>
<td>".$row["M4H2"]."</td><td>".$row["M4A2"]."</td><td>".($row["M4H2"] > $row["M4A2"]?1:0)."</td><td>".($row["M4H2"] < $row["M4A2"]?1:0)."</td></tr>");
echo("<tr><td></td><td></td><td></td></tr>");

echo("<tr></tr><td rowspan='2'>".$row["M1f"]." and ".$row["M2f"]."</td><td rowspan='2'>v</td><td rowspan='2'>".$row["AM1f"]." and ".$row["AM2f"]."</td>
<td>".$row["M5H1"]."</td><td>".$row["M5A1"]."</td><td>".($row["M5H1"] > $row["M5A1"]?1:0)."</td><td>".($row["M5H1"] < $row["M5A1"]?1:0)."</td></tr>
<td>".$row["M5H2"]."</td><td>".$row["M5A2"]."</td><td>".($row["M5H2"] > $row["M5A2"]?1:0)."</td><td>".($row["M5H2"] < $row["M5A2"]?1:0)."</td></tr>");
echo("<tr><td></td><td></td><td></td></tr>");

echo("<tr></tr><td rowspan='2'>".$row["L1f"]." and ".$row["L2f"]."</td><td rowspan='2'>v</td><td rowspan='2'>".$row["AL1f"]." and ".$row["AL2f"]."</td>
<td>".$row["M6H1"]."</td><td>".$row["M6A1"]."</td><td>".($row["M6H1"] > $row["M6A1"]?1:0)."</td><td>".($row["M6H1"] < $row["M6A1"]?1:0)."</td></tr>
<td>".$row["M6H2"]."</td><td>".$row["M6A2"]."</td><td>".($row["M6H2"] > $row["M6A2"]?1:0)."</td><td>".($row["M6H2"] < $row["M6A2"]?1:0)."</td></tr>");
echo("<tr><td></td><td></td><td></td></tr>");

echo("<tr></tr><td rowspan='2'>".$row["L3f"]." and ".$row["M3f"]."</td><td rowspan='2'>v</td><td rowspan='2'>".$row["AL3f"]." and ".$row["AM3f"]."</td>
<td>".$row["M7H1"]."</td><td>".$row["M7A1"]."</td><td>".($row["M7H1"] > $row["M7A1"]?1:0)."<td>".($row["M7H1"] < $row["M7A1"]?1:0)."</td></tr>
<td>".$row["M7H2"]."</td><td>".$row["M7A2"]."</td><td>".($row["M7H2"] > $row["M7A2"]?1:0)."<td>".($row["M7H2"] < $row["M7A2"]?1:0)."</td></tr>");
echo("<tr><td></td><td></td><td></td></tr>");

echo("<tr></tr><td rowspan='2'>".$row["L1f"]." and ".$row["M1f"]."</td><td rowspan='2'>v</td><td rowspan='2'>".$row["AL1f"]." and ".$row["AM1f"]."</td>
<td>".$row["M8H1"]."</td><td>".$row["M8A1"]."</td><td>".($row["M8H1"] > $row["M8A1"]?1:0)."<td>".($row["M8H1"] < $row["M8A1"]?1:0)."</td></tr>
<td>".$row["M8H2"]."</td><td>".$row["M8A2"]."</td><td>".($row["M8H2"] > $row["M8A2"]?1:0)."<td>".($row["M8H2"] < $row["M8A2"]?1:0)."</td></tr>");
echo("<tr><td></td><td></td><td></td></tr>");

echo("<tr></tr><td rowspan='2'>".$row["L3f"]." and ".$row["M2f"]."</td><td rowspan='2'>v</td><td rowspan='2'>".$row["AL3f"]." and ".$row["AM2f"]."</td>
<td>".$row["M9H1"]."</td><td>".$row["M9A1"]."</td><td>".($row["M9H1"] > $row["M9A1"]?1:0)."<td>".($row["M9H1"] < $row["M9A1"]?1:0)."</td></tr>
<td>".$row["M9H2"]."</td><td>".$row["M9A2"]."</td><td>".($row["M9H2"] > $row["M9A2"]?1:0)."<td>".($row["M9H2"] < $row["M9A2"]?1:0)."</td></tr>");
echo("<tr><td></td><td></td><td></td></tr>");

echo("<tr></tr><td rowspan='2'>".$row["L2f"]." and ".$row["M3f"]."</td><td rowspan='2'>v</td><td rowspan='2'>".$row["AL2f"]." and ".$row["AM3f"]."</td>
<td>".$row["M10H1"]."</td><td>".$row["M10A1"]."</td><td>".($row["M10H1"] > $row["M10A1"]?1:0)."<td>".($row["M10H1"] < $row["M10A1"]?1:0)."</td></tr>
<td>".$row["M10H2"]."</td><td>".$row["M10A2"]."</td><td>".($row["M10H2"] > $row["M10A2"]?1:0)."<td>".($row["M10H2"] < $row["M10A2"]?1:0)."</td></tr>");
echo("<tr><td></td><td></td><td></td></tr>");
echo("<tr><td></td><td></td><td>Totals</td><td>".$Hometotal."</td><td>".$Awaytotal."</td><td>".$homegametotal."</td><td>".$awaygametotal."</td></tr>");
echo("</table>");
$conn=null;


?>
</body>
</html>