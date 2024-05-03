<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
header("Location:index.php");
if (!isset($_SESSION['name']))
{
    header("Location:login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
}
#include "setseason.php";

include_once ("connect.php");
if ($_SESSION["SEASON"]!=$_POST["seasoncode"]){
    //need to check if seasonname already exists before doing this to prevent extra matches being created
    $stmt=$conn->prepare("UPDATE currentseason SET currentseason=:newseason WHERE currentseason=:currentseason");
    $stmt->bindParam(':newseason', $_POST['seasoncode']);
    $stmt->bindParam(':currentseason', $_SESSION["SEASON"]);
    $stmt->execute();
    $stmt1=$conn->prepare("INSERT INTO seasonlist (seasoncode,seasonname) VALUES (:seasoncode, :seasonname)");
    $stmt1->bindParam(':seasoncode', $_POST['seasoncode']);
    $stmt1->bindParam(':seasonname', $_POST['seasonname']);
    $stmt1->execute();
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
                $stmt->bindParam(':season', $_POST['seasoncode']);
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
                $stmt->bindParam(':season', $_POST['seasoncode']);
                $stmt->execute(); 
            }
        }
        
}
echo ("fixtures created");    
$_SESSION["SEASON"]=  $_POST['seasoncode'];
}else{
    echo("nothing to do");
}  
?>