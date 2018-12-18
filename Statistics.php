
<!DOCTYPE html>
<html>
<head>
    <title>Statistics</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href='https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css'>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
    $(function() {
        $("#navigation").load("navbar.php");
        });
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#players').DataTable({
            "order": [[ 3, "desc" ],[9,"desc"]],//) index colum to sort by
            "pageLength": 20
        });
    } );
    </script>
</head>
<body>
<div id="navigation"></div>
<div class="container-fluid" style="margin-top:80px">
<H1>Player Statistics</H1>
<?php
include_once ("connect.php");
$stmt1 = $conn->prepare("SELECT schools.Schoolname as SN, Surname, Forename,UserID, Gender FROM players 
INNER JOIN schools  ON players.School=schools.SchoolID 
WHERE Active=1" );
$stmt1->execute();
while ($player = $stmt1->fetch(PDO::FETCH_ASSOC))
{
    $stmt = $conn->prepare("SELECT Fixtures.FixtDate, 
    Fixtures.M1H1,Fixtures.M1A1,
    Fixtures.M2H1,Fixtures.M2A1,
    Fixtures.M3H1,Fixtures.M3A1,Fixtures.M3H2,Fixtures.M3A2,
    Fixtures.M4H1,Fixtures.M4A1,Fixtures.M4H2,Fixtures.M4A2,
    Fixtures.M5H1,Fixtures.M5A1,Fixtures.M5H2,Fixtures.M5A2,
    Fixtures.M6H1,Fixtures.M6A1,Fixtures.M6H2,Fixtures.M6A2,
    Fixtures.M7H1,Fixtures.M7A1,Fixtures.M7H2,Fixtures.M7A2,
    Fixtures.M8H1,Fixtures.M8A1,Fixtures.M8H2,Fixtures.M8A2,
    Fixtures.M9H1,Fixtures.M9A1,Fixtures.M9H2,Fixtures.M9A2,
    Fixtures.M10H1,Fixtures.M10A1,Fixtures.M10H2,Fixtures.M10A2,
    Fixtures.HomeID as Home, Fixtures.AwayID as Away,FixtureID,
    M1.UserID as M1U, 
    M2.UserID as M2U, 
    M3.UserID as M3U, 
    L1.UserID as L1U, 
    L2.UserID as L2U, 
    L3.UserID as L3U, 
    AM1.UserID as AM1U,
    AM2.UserID as AM2U,
    AM3.UserID as AM3U,
    AL1.UserID as AL1U,
    AL2.UserID as AL2U,
    AL3.UserID as AL3U,
    awsc.Schoolname as AWS, hsch.Schoolname as HS, 
    awsc.SchoolID as AWSID, hsch.SchoolID as HSID,
    home.teamID as HTID, away.teamID as ATID,
    home.Division as AWD, away.Division as HD
    FROM Fixtures 
    INNER JOIN  Players as M1 on HM1ID = M1.UserID
    INNER JOIN  Players as M2 on HM2ID = M2.UserID
    INNER JOIN  Players as M3 on HM3ID = M3.UserID
    INNER JOIN  Players as L1 on HL1ID = L1.UserID
    INNER JOIN  Players as L2 on HL2ID = L2.UserID
    INNER JOIN  Players as L3 on HL3ID = L3.UserID
    INNER JOIN  Players as AM1 on AM1ID = AM1.UserID
    INNER JOIN  Players as AM2 on AM2ID = AM2.UserID
    INNER JOIN  Players as AM3 on AM3ID = AM3.UserID
    INNER JOIN  Players as AL1 on AL1ID = AL1.UserID
    INNER JOIN  Players as AL2 on AL2ID = AL2.UserID
    INNER JOIN  Players as AL3 on AL3ID = AL3.UserID
    INNER JOIN Teams as home ON (Fixtures.HomeID = home.teamID) 
    INNER JOIN  Teams as away ON (Fixtures.AwayID=away.TeamID) 
    INNER JOIN Schools as awsc ON away.SchoolID=awsc.SchoolID 
    INNER JOIN Schools as hsch ON home.SchoolID=hsch.SchoolID");
    $stmt->execute();
    $totpts=0;
    $totgames=0;
    $totgameslost=0;
    $totptsagainst=0;
    $count=0;
    $m1hgames=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $Awaytotal=$row["M1A1"]+$row["M2A1"]+$row["M3A1"]+$row["M3A2"]+$row["M4A1"]+$row["M4A2"]+$row["M5A1"]+$row["M5A2"]+$row["M6A1"]+$row["M6A2"]+$row["M7A1"]+$row["M7A2"]+$row["M8A1"]+$row["M8A2"]+$row["M9A1"]+$row["M9A2"]+$row["M10A1"]+$row["M10A2"];
        $Hometotal=$row["M1H1"]+$row["M2H1"]+$row["M3H1"]+$row["M3H2"]+$row["M4H1"]+$row["M4H2"]+$row["M5H1"]+$row["M5H2"]+$row["M6H1"]+$row["M6H2"]+$row["M7H1"]+$row["M7H2"]+$row["M8H1"]+$row["M8H2"]+$row["M9H1"]+$row["M9H2"]+$row["M10H1"]+$row["M10H2"];
        if((int)$row["M1U"]==(int)$player["UserID"]){
            $totpts=$totpts+($row["M1H1"]+$row["M5H1"]+$row["M5H2"]+$row["M8H1"]+$row["M8H2"]);
            $totptsagainst=$totptsagainst+($row["M1A1"]+$row["M5A1"]+$row["M5A2"]+$row["M8A1"]+$row["M8A2"]);
            $count+=5;
            if($row['M1H1']>$row['M1A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M5H1']>$row['M5A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M5H2']>$row['M5A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M8H1']>$row['M8A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M8H2']>$row['M8A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
        }else if ((int)$row["M2U"]==(int)$player["UserID"]){
            $count+=6;
            $totpts=$totpts+($row["M3H1"]+$row["M3H2"]+$row["M5H1"]+$row["M5H2"]+$row["M9H1"]+$row["M9H2"]);
            $totptsagainst=$totptsagainst+($row["M3A1"]+$row["M3A2"]+$row["M5A1"]+$row["M5A2"]+$row["M9A1"]+$row["M9A2"]);
            if($row['M3H1']>$row['M3A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M3H2']>$row['M3A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M5H1']>$row['M5A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M5H2']>$row['M5A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M9H1']>$row['M9A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M9H2']>$row['M9A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
        }else if ((int)$row["M3U"]==(int)$player["UserID"] ){
            $count+=6;
            $totpts=$totpts+($row["M3H1"]+$row["M3H2"]+$row["M7H1"]+$row["M7H2"]+$row["M10H1"]+$row["M10H2"]);
            $totptsagainst=$totptsagainst+($row["M3A1"]+$row["M3A2"]+$row["M7A1"]+$row["M7A2"]+$row["M10A1"]+$row["M10A2"]);
            if($row['M3H1']>$row['M3A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M3H2']>$row['M3A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M7H1']>$row['M7A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M7H2']>$row['M7A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M10H1']>$row['M10A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M10H2']>$row['M10A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
        }else if((int)$row["L1U"]==(int)$player["UserID"] ){
            $count+=5;
            $totpts=$totpts+($row["M2H1"]+$row["M6H1"]+$row["M6H2"]+$row["M8H1"]+$row["M8H2"]);
            $totptsagainst=$totptsagainst+($row["M2A1"]+$row["M6A1"]+$row["M6A2"]+$row["M8A1"]+$row["M8A2"]);
            if($row['M2H1']>$row['M2A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M6H1']>$row['M6A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M6H2']>$row['M6A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M8H1']>$row['M8A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M8H2']>$row['M8A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
        }else if ((int)$row["L2U"]==(int)$player["UserID"] ){
            $count+=6;
            $totpts=$totpts+($row["M4H1"]+$row["M4H2"]+$row["M6H1"]+$row["M6H2"]+$row["M10H1"]+$row["M10H2"]);
            $totptsagainst=$totptsagainst+($row["M4A1"]+$row["M4A2"]+$row["M6A1"]+$row["M6A2"]+$row["M10A1"]+$row["M10A2"]);
            if($row['M4H1']>$row['M4A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M4H2']>$row['M4A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M6H1']>$row['M6A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M6H2']>$row['M6A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M10H1']>$row['M10A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M10H2']>$row['M10A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
        }else if((int)$row["L3U"]==(int)$player["UserID"] ){
            $count+=6;
            $totpts=$totpts+($row["M4H1"]+$row["M4H2"]+$row["M7H1"]+$row["M7H2"]+$row["M9H1"]+$row["M9H2"]);
            $totptsagainst=$totptsagainst+($row["M4A1"]+$row["M4A2"]+$row["M7A1"]+$row["M7A2"]+$row["M9A1"]+$row["M9A2"]);
            if($row['M4H1']>$row['M4A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M4H2']>$row['M4A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M7H1']>$row['M7A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M7H2']>$row['M7A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M9H1']>$row['M9A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M9H2']>$row['M9A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
        }else if((int)$row["AM1U"]==(int)$player["UserID"] ){
            $count+=5;
            $totpts=$totpts+($row["M1A1"]+$row["M5A1"]+$row["M5A2"]+$row["M8A1"]+$row["M8A2"]);
            $totptsagainst=$totptsagainst+($row["M1H1"]+$row["M5H1"]+$row["M5H2"]+$row["M8H1"]+$row["M8H2"]);
            if($row['M1H1']<$row['M1A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M5H1']<$row['M5A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M5H2']<$row['M5A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M8H1']<$row['M8A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M8H2']<$row['M8A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
        }else if ((int)$row["AM2U"]==(int)$player["UserID"] ){
            $count+=6;
            $totpts=$totpts+($row["M3A1"]+$row["M3A2"]+$row["M5A1"]+$row["M5A2"]+$row["M9A1"]+$row["M9A2"]);
            $totptsagainst=$totptsagainst+($row["M3H1"]+$row["M3H2"]+$row["M5H1"]+$row["M5H2"]+$row["M9H1"]+$row["M9H2"]);
            if($row['M3H1']<$row['M3A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M3H2']<$row['M3A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M5H1']<$row['M5A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M5H2']<$row['M5A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M9H1']<$row['M9A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M9H2']<$row['M9A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
        }else if((int)$row["AM3U"]==(int)$player["UserID"] ){
            $count+=6;
            $totpts=$totpts+($row["M3A1"]+$row["M3A2"]+$row["M7A1"]+$row["M7A2"]+$row["M10A1"]+$row["M10A2"]);
            $totptsagainst=$totptsagainst+($row["M3H1"]+$row["M3H2"]+$row["M7H1"]+$row["M7H2"]+$row["M10H1"]+$row["M10H2"]);
            if($row['M3H1']<$row['M3A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M3H2']<$row['M3A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M7H1']<$row['M7A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M7H2']<$row['M7A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M10H1']<$row['M10A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M10H2']<$row['M10A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
        }else if((int)$row["AL1U"]==(int)$player["UserID"] ){
            $count+=5;
            $totpts=$totpts+($row["M2A1"]+$row["M6A1"]+$row["M6A2"]+$row["M8A1"]+$row["M8A2"]);
            $totptsagainst=$totptsagainst+($row["M2H1"]+$row["M6H1"]+$row["M6H2"]+$row["M8H1"]+$row["M8H2"]);
            if($row['M2H1']<$row['M2A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M6H1']<$row['M6A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M6H2']<$row['M6A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M8H1']<$row['M8A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M8H2']<$row['M8A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
        }else if((int)$row["AL2U"]==(int)$player["UserID"] ){
            $count+=6;
            $totpts=$totpts+($row["M4A1"]+$row["M4A2"]+$row["M6A1"]+$row["M6A2"]+$row["M10A1"]+$row["M10A2"]);
            $totptsagainst=$totptsagainst+($row["M4H1"]+$row["M4H2"]+$row["M6H1"]+$row["M6H2"]+$row["M10H1"]+$row["M10H2"]);
            if($row['M4H1']<$row['M4A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M4H2']<$row['M4A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M6H1']<$row['M6A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M6H2']<$row['M6A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M10H1']<$row['M10A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M10H2']<$row['M10A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
        }else if((int)$row["AL3U"]==(int)$player["UserID"] ){
            $count+=6;
            $totpts=$totpts+($row["M4A1"]+$row["M4A2"]+$row["M7A1"]+$row["M7A2"]+$row["M9A1"]+$row["M9A2"]);
            $totptsagainst=$totptsagainst+($row["M4H1"]+$row["M4H2"]+$row["M7H1"]+$row["M7H2"]+$row["M9H1"]+$row["M9H2"]);
            if($row['M4H1']<$row['M4A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M4H2']<$row['M4A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M7H1']<$row['M7A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M7H2']<$row['M7A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M9H1']<$row['M9A1']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
            if($row['M9H2']<$row['M9A2']){
                $totgames+=1;
            }else{
                $totgameslost+=1;
            }
        }


    }
    $playerres=array('forename'=>$player['Forename'],'surname'=>$player['Surname'],'school'=>$player['SN'],'gameswon'=>$totgames,'gameslost'=>$totgameslost,'pointsfor'=>$totpts,'pointsagainst'=>$totptsagainst,'gamesplayed'=>$count);
    $leagueA[]=array($playerres);
        
    
}
echo("<table id='players' style = 'width:100%'  class='table table-striped table-bordered' role='grid'>");
echo("<thead><th>Forename</th><th>Surname</th><th>School</th><th>Win Percentage</th><th>Played</th><th>Games Won</th><th>Games Lost</th><th>Points for</th><th>Points against</th><th>avg points difference</th></thead><tbody>");
foreach ($leagueA AS $plyr){
    foreach($plyr as $bob){
        echo("<tr><td>".$bob['forename']."</td><td>".$bob['surname']."</td><td>".$bob['school']."</td>
        <td>".$percent=round((($bob['gameswon'] /($bob['gameswon'] +$bob['gameslost'] ))*100),2)."%</td>
        <td>".$bob['gamesplayed']."</td><td>".$bob['gameswon']."</td><td>".$bob['gameslost']."</td>
        <td>".$bob['pointsfor']."</td><td>".$bob['pointsagainst']."</td>
        <td>".number_format((((int)$bob['pointsfor']-(int)$bob['pointsagainst'])/(int)$bob['gamesplayed']),2)."</td></tr>");
    }
}
echo("</tbody></table>");
//print_r($leagueA);
            /* ((int)$row["M2U"]==(int)$player["UserID"])||
            ((int)$row["M3U"]==(int)$player["UserID"] )||
            ((int)$row["L1U"]==(int)$player["UserID"] )||
            ((int)$row["L2U"]==(int)$player["UserID"] )||
            ((int)$row["L3U"]==(int)$player["UserID"] )||
            ((int)$row["AM1U"]==(int)$player["UserID"] )||
            ((int)$row["AM2U"]==(int)$player["UserID"] )||
            ((int)$row["AM3U"]==(int)$player["UserID"] )||
            ((int)$row["AL1U"]==(int)$player["UserID"] )||
            ((int)$row["AL2U"]==(int)$player["UserID"] )||
            ((int)$row["AL3U"]==(int)$player["UserID"] )){
                $totpts+=$row[Hometotal;
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
            }else if ((int)$row["ATID"]==(int)$player["TID"]){
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

        $teamres=array('forename'=>$player['Forename'],'surname'=>$player['Surname'],'played'=>$count, 'gameswon'=>$totgames,'gameslost'=>$totgameslost,'pointsfor'=>$totpts,'pointsagainst'=>$totptsagainst);
        $leagueA[]=$teamres;
    }
}      

    

*/

?>

</div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
</body>
</html>
