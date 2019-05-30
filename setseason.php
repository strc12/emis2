<?php

include_once "connect.php";
$stmt=$conn->prepare("SELECT * FROM seasons WHERE current=1;");
//$stmt = $conn->prepare("SELECT * FROM currentseason;" );
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$_SEASON=$row["SeasonID"];
?>