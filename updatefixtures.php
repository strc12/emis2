<?php
session_start();
if (!isset($_SESSION['name']))
{
    header("Location:index.php");
}
include_once ("connect.php");
array_map("htmlspecialchars", $_POST);
$keys=array_keys($_POST);//extracts keys as a separate array
foreach($keys as $fixt){
    $stmt = $conn->prepare("UPDATE fixtures SET fixtdate=:fixtdate WHERE FixtureID=$fixt");
    $stmt->bindParam(':fixtdate', $_POST[$fixt]);    
    $stmt->execute();
}

header("Location:fixtures.php");
?>