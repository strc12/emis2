<?php
session_start();
header("Location:index.php");
include "setseason.php";
include_once ("connect.php");
if ($_SEASON!=$_POST["season"]){
    $stmt=$conn->prepare("UPDATE currentseason SET currentseason=:newseason WHERE currentseason=:currentseason");
    $stmt->bindParam(':newseason', $_POST['season']);
    $stmt->bindParam(':currentseason', $_SEASON);
    $stmt->execute();
    $stmtA = $conn->prepare("SELECT * FROM teams WHERE division='A'");
    $stmtA->execute();
    $result = $stmtA->fetchAll(\PDO::FETCH_ASSOC);
    $arrlength = count($result);

    for($x = 0; $x < $arrlength; $x++) {
        for($y = 0; $y<$arrlength; $y++){
            
            if ($result[$x]['TeamID']!=$result[$y]['TeamID']){
                $stmt = $conn->prepare("INSERT INTO fixtures (FixtureID,HomeID, AwayID,FixtDate,Season)VALUES(NULL,:Home,:Away,NULL,:season)");
                $stmt->bindParam(':Home', $result[$x]['TeamID']);
                $stmt->bindParam(':Away', $result[$y]['TeamID']);
                $stmt->bindParam(':season', $_POST['season']);
                $stmt->execute(); 
            }
        }
        
    }
    $stmtB = $conn->prepare("SELECT * FROM teams WHERE division='B'");
    $stmtB->execute();
    $result = $stmtB->fetchAll(\PDO::FETCH_ASSOC);
    $arrlength = count($result);

    for($x = 0; $x < $arrlength; $x++) {
        for($y = 0; $y<$arrlength; $y++){
            
            if ($result[$x]['TeamID']!=$result[$y]['TeamID']){
                $stmt = $conn->prepare("INSERT INTO fixtures (FixtureID,HomeID, AwayID,FixtDate,Season)VALUES(NULL,:Home,:Away,NULL,:season)");
                $stmt->bindParam(':Home', $result[$x]['TeamID']);
                $stmt->bindParam(':Away', $result[$y]['TeamID']);
                $stmt->bindParam(':season', $_POST['season']);
                $stmt->execute(); 
            }
        }
        
}
echo ("fixtures created");      
}else{
    echo("nothing to do");
}  
?>