<!DOCTYPE html>
<html>
<head>
    
    <title>League Tables</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="shortcut icon" href="images/favicon.ico">
  <script>
  $(function() {
    $("#navigation").load("navbar.php");
    });
</script>
<?php

?>
<style>

td,th,thead{
    text-align:center;
}
</style>
</head>
<body>
<div id="navigation"></div>
<div class="container-fluid" style="margin-top:10px">
<h2>League Tables:</h2>

    
<?php
include_once ("connect.php");
include_once ("setseason.php");

/*echo ("<label>Select season</label>
<select name='season'>"); 
$stmt=$conn->prepare("SELECT * FROM seasonlist");
//$stmt = $conn->prepare("SELECT * FROM currentseason;" );
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    #print_r($row);
    echo ("<option value='".$row["seasoncode"]."'>".$row["seasonname"]."</option>");
}
    echo ("</select>"); */

$leagues=array("A","B");

foreach($leagues as $div){
    echo("<h3>League ".$div."</h3>");
    $leagueA=array();
    $stmt1 = $conn->prepare("SELECT schools.Schoolname as SN, TeamID as TID , Division FROM teams 
    INNER JOIN schools  ON teams.SchoolID=schools.SchoolID 
    WHERE Division=:Division" );
    $stmt1->bindParam(':Division', $div);


    $stmt1->execute();


    while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
    {
        $stmt = $conn->prepare("SELECT fixtures.FixtDate, fixtures.Season,
        fixtures.M1H1,fixtures.M1A1,
        fixtures.M2H1,fixtures.M2A1,
        fixtures.M3H1,fixtures.M3A1,fixtures.M3H2,fixtures.M3A2,
        fixtures.M4H1,fixtures.M4A1,fixtures.M4H2,fixtures.M4A2,
        fixtures.M5H1,fixtures.M5A1,fixtures.M5H2,fixtures.M5A2,
        fixtures.M6H1,fixtures.M6A1,fixtures.M6H2,fixtures.M6A2,
        fixtures.M7H1,fixtures.M7A1,fixtures.M7H2,fixtures.M7A2,
        fixtures.M8H1,fixtures.M8A1,fixtures.M8H2,fixtures.M8A2,
        fixtures.M9H1,fixtures.M9A1,fixtures.M9H2,fixtures.M9A2,
        fixtures.M10H1,fixtures.M10A1,fixtures.M10H2,fixtures.M10A2,
        fixtures.HomeID as Home, fixtures.AwayID as Away,  
        M1.Forename as M1f, M1.Surname as M1s, 
        M2.Forename as M2f, M2.Surname as M2s,
        M3.Forename as M3f, M3.Surname as M3s,
        L1.Forename as L1f, L1.Surname as L1s,
        L2.Forename as L2f, L2.Surname as L2s,
        L3.Forename as L3f, L3.Surname as L3s,
        AM1.Forename as AM1f, AM1.Surname as AM1s, 
        AM2.Forename as AM2f, AM2.Surname as AM2s,
        AM3.Forename as AM3f, AM3.Surname as AM3s,
        AL1.Forename as AL1f, AL1.Surname as AL1s,
        AL2.Forename as AL2f, AL2.Surname as AL2s,
        AL3.Forename as AL3f, AL3.Surname as AL3s,
        awsc.Schoolname as AWS, hsch.Schoolname as HS, 
        awsc.SchoolID as AWSID, hsch.SchoolID as HSID,
        home.teamID as HTID, away.teamID as ATID,
        home.Division as AWD, away.Division as HD
        FROM fixtures 
        INNER JOIN  players as M1 on HM1ID = M1.UserID
        INNER JOIN  players as M2 on HM2ID = M2.UserID
        INNER JOIN  players as M3 on HM3ID = M3.UserID
        INNER JOIN  players as L1 on HL1ID = L1.UserID
        INNER JOIN  players as L2 on HL2ID = L2.UserID
        INNER JOIN  players as L3 on HL3ID = L3.UserID
        INNER JOIN  players as AM1 on AM1ID = AM1.UserID
        INNER JOIN  players as AM2 on AM2ID = AM2.UserID
        INNER JOIN  players as AM3 on AM3ID = AM3.UserID
        INNER JOIN  players as AL1 on AL1ID = AL1.UserID
        INNER JOIN  players as AL2 on AL2ID = AL2.UserID
        INNER JOIN  players as AL3 on AL3ID = AL3.UserID
        INNER JOIN teams as home ON (fixtures.HomeID = home.teamID) 
        INNER JOIN teams as away ON (fixtures.AwayID=away.TeamID) 
        INNER JOIN schools as awsc ON away.SchoolID=awsc.SchoolID 
        INNER JOIN schools as hsch ON home.SchoolID=hsch.SchoolID 
        WHERE (away.TeamID=:AWSID and fixtures.Season=:SEAS) OR (fixtures.Season=:SEAS and home.TeamID=:HSID)" );
        $stmt->bindParam(':AWSID', $row1['TID']);
        $stmt->bindParam(':HSID', $row1['TID']);
        $stmt->bindParam(':SEAS', $_SESSION["SEASON"]);
        $stmt->execute();
        $totpts=0;
        $totgames=0;
        $totgameslost=0;
        $totptsagainst=0;
        $count=0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            //print_r($row);
            $count+=1;
            $Awaytotal=$row["M1A1"]+$row["M2A1"]+$row["M3A1"]+$row["M3A2"]+$row["M4A1"]+$row["M4A2"]+$row["M5A1"]+$row["M5A2"]+$row["M6A1"]+$row["M6A2"]+$row["M7A1"]+$row["M7A2"]+$row["M8A1"]+$row["M8A2"]+$row["M9A1"]+$row["M9A2"]+$row["M10A1"]+$row["M10A2"];
            $Hometotal=$row["M1H1"]+$row["M2H1"]+$row["M3H1"]+$row["M3H2"]+$row["M4H1"]+$row["M4H2"]+$row["M5H1"]+$row["M5H2"]+$row["M6H1"]+$row["M6H2"]+$row["M7H1"]+$row["M7H2"]+$row["M8H1"]+$row["M8H2"]+$row["M9H1"]+$row["M9H2"]+$row["M10H1"]+$row["M10H2"];
            if((int)$row["HTID"]==(int)$row1["TID"]){
                $totpts+=$Hometotal;
                $totptsagainst+=$Awaytotal;
                $homegametotal=0;
                $gameslost=0;
                if($row["M1H1"] > $row["M1A1"]){
                    $homegametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M2H1"] > $row["M2A1"]){
                    $homegametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M3H1"] > $row["M3A1"]){
                    $homegametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M3H2"] > $row["M3A2"]){
                    $homegametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M4H1"] > $row["M4A1"]){
                    $homegametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M4H2"] > $row["M4A2"]){
                    $homegametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M5H1"] > $row["M5A1"]){
                    $homegametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M5H2"] > $row["M5A2"]){
                    $homegametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M6H1"] > $row["M6A1"]){
                    $homegametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M6H2"] > $row["M6A2"]){
                    $homegametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M7H1"] > $row["M7A1"]){
                    $homegametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M7H2"] > $row["M7A2"]){
                    $homegametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M8H1"] > $row["M8A1"]){
                    $homegametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M8H2"] > $row["M8A2"]){
                    $homegametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M9H1"] > $row["M9A1"]){
                    $homegametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M9H2"] > $row["M9A2"]){
                    $homegametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M10H1"] > $row["M10A1"]){
                    $homegametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M10H2"] > $row["M10A2"]){
                    $homegametotal+=1;
                }else{
                    $gameslost+=1;
                }
                $totgames+=$homegametotal;
                $totgameslost+=$gameslost;
            }else if ((int)$row["ATID"]==(int)$row1["TID"]){
                $totpts+=$Awaytotal;
                $totptsagainst+=$Hometotal;
                $awaygametotal=0;
                $gameslost=0;
                if($row["M1H1"] < $row["M1A1"]){
                    $awaygametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M2H1"] < $row["M2A1"]){
                    $awaygametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M3H1"] < $row["M3A1"]){
                    $awaygametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M3H2"] < $row["M3A2"]){
                    $awaygametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M4H1"] < $row["M4A1"]){
                    $awaygametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M4H2"] < $row["M4A2"]){
                    $awaygametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M5H1"] < $row["M5A1"]){
                    $awaygametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M5H2"] < $row["M5A2"]){
                    $awaygametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M6H1"] < $row["M6A1"]){
                    $awaygametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M6H2"] < $row["M6A2"]){
                    $awaygametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M7H1"] < $row["M7A1"]){
                    $awaygametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M7H2"] < $row["M7A2"]){
                    $awaygametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M8H1"] < $row["M8A1"]){
                    $awaygametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M8H2"] < $row["M8A2"]){
                    $awaygametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M9H1"] < $row["M9A1"]){
                    $awaygametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M9H2"] < $row["M9A2"]){
                    $awaygametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M10H1"] < $row["M10A1"]){
                    $awaygametotal+=1;
                }else{
                    $gameslost+=1;
                }
                if($row["M10H2"] < $row["M10A2"]){
                    $awaygametotal+=1;
                }else{
                    $gameslost+=1;
                }   
                $totgames+=$awaygametotal;         
                $totgameslost+=$gameslost;
            }  
        }

        $teamres=array('name'=>$row1['SN'],'played'=>$count, 'gameswon'=>$totgames,'gameslost'=>$totgameslost,'pointsfor'=>$totpts,'pointsagainst'=>$totptsagainst);
        $leagueA[]=$teamres;
        
    }


    
    
    uasort($leagueA,'cmp');
    echo("<table style = 'width:60%'  class='table-bordered table-condensed'>");
    echo("<thead class='thead-dark'><th>Team</th><th>Played</th><th>Games won</th><th>Games lost</th><th>Points for</th><th>Points against</th></thead>");
    foreach ($leagueA as $team){
            echo("<tr><td>".$team['name']."</td><td>".$team['played']."</td><td>".$team['gameswon']."</td><td>".$team['gameslost']."</td><td>".$team['pointsfor']."</td><td>".$team['pointsagainst']."</td></tr>");
    }
    echo("</table>");


}
//callback function for usort- declared outside loop to prevent recalling
function cmp($a, $b)
{   if ($a["gameswon"]<$b['gameswon']){
    return 1;
}else{
    return -1;
}
}
   
?>
</div>



</body>
</html>