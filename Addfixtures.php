<?php

session_start();
include "setseason.php";
//boo
if (!isset($_SESSION['name']))
{
    header("Location:login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
}
include_once ("connect.php");
array_map("htmlspecialchars", $_POST);
print_r($_POST);
$stmt = $conn->prepare("INSERT INTO fixtures (FixtureID,HomeID, AwayID,FixtDate,Season)VALUES(NULL,:Home,:Away,:Fixtdate,:season)");
$stmt->bindParam(':Home', $_POST["HomeID"]);
$stmt->bindParam(':Away', $_POST["AwayID"]);
$stmt->bindParam(':Fixtdate', $_POST["fixtdate"]);
$stmt->bindParam(':season', $_SEASON);
$stmt->execute();
$conn=null;
header("Location:fixtures.php");
?>