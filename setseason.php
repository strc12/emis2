<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
  
include_once "connect.php";
$stmt = $conn->prepare("SELECT * FROM currentseason;" );
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$_SESSION["SEASON"]=$row["currentseason"];
//pick up current season for use later
?>