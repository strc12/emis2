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
$stmt = $conn->prepare("INSERT INTO Fixtures (FixtureID,HomeID, AwayID,FixtDate)VALUES(NULL,:Home,:Away,:Fixtdate)");
$stmt->bindParam(':Home', $_POST["HomeID"]);
$stmt->bindParam(':Away', $_POST["AwayID"]);
$stmt->bindParam(':Fixtdate', $_POST["fixtdate"]);

$stmt->execute();
$conn=null;
header("Location:fixtures.php");
?>