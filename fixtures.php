<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }

if (!isset($_SESSION['name']))
{
    header("Location:index.php");
    //sends referring page as get to login page for correct redirection afterwards
}


?>
<!DOCTYPE html>
<html>
<head>

    <title>Fixtures</title>
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
</head>
<body>
<div id="navigation"></div>
<div class="container-fluid" style="margin-top:10px">
    <form action="updatefixtures.php" method="POST">
    <br>
    <h3>Current Fixtures</h3>
    <p>Date not added in Red, other schools fixtures greyed out</p>
    <?php
    include_once ("connect.php");
    $today = strtotime(date("d-m-Y")); 
    $stmt = $conn->prepare("SELECT FixtureID,HomeID, AwayID, fixtdate, season,
    awsc.Schoolname as AWS, hsch.Schoolname as HS, awsc.Username as AWUN, hsch.Username as HUN,
    home.Division, away.Division FROM fixtures 
    INNER JOIN teams as home ON (fixtures.HomeID = home.teamID) 
    INNER JOIN teams as away ON (fixtures.AwayID=away.TeamID) 
    INNER JOIN schools as awsc ON away.SchoolID=awsc.SchoolID 
    INNER JOIN schools as hsch ON home.SchoolID=hsch.SchoolID 
    WHERE season=:season  ORDER BY fixtdate ASC" );
    $stmt->bindParam(':season', $_SESSION["SEASON"]);   
    $stmt->execute();

    echo("<table><tbody>");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {   
        echo("<tr>");
        if((strtotime($row["fixtdate"])==NULL )){
            echo("<td style='color:#FF0000'>".$row['HS']." ".$row['Division']." v ".$row['AWS']." ".$row['Division']."</td><td><input class='form-control' type='date' id='' name='".$row['FixtureID']."' size='9' value='".$row["fixtdate"]."'></td>");
        }else if ($_SESSION['name']== 'admin'){
            echo("<td style='color:#FF0000'>".$row['HS']." ".$row['Division']." v ".$row['AWS']." ".$row['Division']."</td><td><input class='form-control' type='date'id='' name='".$row['FixtureID']."'size='9' value='".$row["fixtdate"]."'></td>");
        }else if ($row["AWUN"]== $_SESSION["name"] ||$row["HUN"]== $_SESSION["name"]){
            echo("<td>".$row['HS']." ".$row['Division']." v ".$row['AWS']." ".$row['Division']."</td><td><input class='form-control' type='date'id='' name='".$row['FixtureID']."'size='9' value='".$row["fixtdate"]."'></td>");
        }else{
            echo("<td style='color:#C0C0C0'>".$row['HS']." ".$row['Division']." v ".$row['AWS']." ".$row['Division']."</td><td><input disabled class='form-control' type='date'id='' name='".$row['FixtureID']."'size='9' value='".$row["fixtdate"]."'></td>");   
        }
        echo("</tr>");

    }
    

    $conn=null;
    ?>
    </tbody>
    <input class="btn btn-primary mb-2" type="submit" value="Update fixtures"> 
    </table>
</div>
</body>
</html>
