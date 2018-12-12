<?php

session_start();
//boo
if (!isset($_SESSION['name']))
{
    header("Location:login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
}
include_once ("connect.php");
array_map("htmlspecialchars", $_POST);
print_r($_POST);
$stmt = $conn->prepare("UPDATE fixtures set HM1ID=:HM1ID,HM2ID=:HM2ID,HM3ID=:HM3ID,HL1ID=:HL1ID,HL2ID=:HL2ID,HL3ID=:HL3ID,AM1ID=:AM1ID,
AM2ID=:AM2ID,AM3ID=:AM3ID,AL1ID=:AL1ID,AL2ID=:AL2ID,AL3ID=:AL3ID WHERE FixtureID=:fid");
$stmt->bindParam(':fid', $_POST["FixID"]);
$stmt->bindParam(':HM1ID', $_POST["homeman1"]);
$stmt->bindParam(':HM2ID', $_POST["homeman2"]);
$stmt->bindParam(':HM3ID', $_POST["homeman3"]);
$stmt->bindParam(':HL1ID', $_POST["homelady1"]);
$stmt->bindParam(':HL2ID', $_POST["homelady2"]);
$stmt->bindParam(':HL3ID', $_POST["homelady3"]);
$stmt->bindParam(':AM1ID', $_POST["awayman1"]);
$stmt->bindParam(':AM2ID', $_POST["awayman2"]);
$stmt->bindParam(':AM3ID', $_POST["awayman3"]);
$stmt->bindParam(':AL1ID', $_POST["awaylady1"]);
$stmt->bindParam(':AL2ID', $_POST["awaylady2"]);
$stmt->bindParam(':AL3ID', $_POST["awaylady3"]);


$stmt->execute();
$conn=null;
$_SESSION["fid"]=$_POST["FixID"];
echo $_SESSION["fid"];
header("Location:Enterscores.php");
//echo("doine");
?>