<?php
session_start();
header("Location:index.php");
if (!isset($_SESSION['name']))
{
    header("Location:login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
}
include "setseason.php";
include_once ("connect.php");
if ($_SEASON!=$_POST["season"]){
    //need to check if seasonname already exists before doing this to prevent extra matches being created
    $stmt=$conn->prepare("INSERT INTO seasons (SeasonID,Term,current,active) VALUES (NULL,:newseason,1,NULL)");
    $stmt->bindParam(':newseason', $_POST['season']);
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