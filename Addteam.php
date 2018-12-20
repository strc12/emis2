<?php

session_start();
header("Location:Teams.php");
if (!isset($_SESSION['name']))
{
    header("Location:login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
}
include_once ("connect.php");
array_map("htmlspecialchars", $_POST);
//print_r($_POST);

$stmt = $conn->prepare("INSERT INTO teams VALUES (NULL,:SchoolID,:Division);" );
$stmt->bindParam(':SchoolID', $_POST['SchoolID']);
$stmt->bindParam(':Division', $_POST['division']);


$stmt->execute();
$conn=null;

?>
