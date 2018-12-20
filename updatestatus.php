<?php
session_start();
//print_r($_POST);
if (!isset($_SESSION['name']))
{
    header("Location:index.php");
}

include_once ("connect.php");
array_map("htmlspecialchars", $_POST);
$keys=array_keys($_POST);//extracts keys as a separate array
foreach($keys as $player){
    
    //echo($player."<br>");
    $stmt = $conn->prepare("UPDATE players SET Active=:active WHERE UserID=$player");
    $stmt->bindParam(':active', $_POST[$player]);    
    $stmt->execute();
}

header("Location:Manageplayers.php");
?>