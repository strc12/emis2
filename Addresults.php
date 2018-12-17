<!DOCTYPE html>
<html>
<head>
<title>Results</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  
<style>
.table td.fit, 
.table th.fit {
    white-space: nowrap;
    width: 1%;
}
td,th{
    text-align:center;
}
</style>
<?php
function popdropdown($sch,$sex,$position){
	echo "<select name='$position' id='$position'>";
	include ('connect.php');//hides connection details
    $stmt=$conn->prepare("SELECT forename, surname, userID FROM players where School = ".$sch." and Gender='".$sex."'");
    $stmt->bindParam(':sid', $sch);
    $stmt->bindParam(':sex', $sex);
    $stmt->execute();   
	echo "<option value='' selected disabled>Please select a Player...</option>";
// GOING THROUGH THE DATA
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{	
			//code for drop down list
			echo '<option value="' . $row['userID'] . '">' . $row['forename'] ." ". $row['surname'] .'</option>';
			
	}
    echo("</select>");
}
?>
</head>
<body>

<?php
$q = intval($_GET['q']);

//echo ($q);
include_once ("connect.php");
$stmt3=$conn->prepare("SELECT FixtureID,HomeID, AwayID, fixtdate,home.teamID as HT, hsch.schoolID as HSID, awsc.schoolID as ASID,
awsc.Schoolname as AWS, hsch.Schoolname as HS, home.Division as hd, away.Division as ad FROM Fixtures 
INNER JOIN Teams as home ON (Fixtures.HomeID = home.teamID) 
INNER JOIN  Teams as away ON (Fixtures.AwayID=away.TeamID) 
INNER JOIN Schools as awsc ON away.SchoolID=awsc.SchoolID 
INNER JOIN Schools as hsch ON home.SchoolID=hsch.SchoolID 
WHERE fixtures.FixtureID=:id");
$stmt3->bindParam(':id', $q);
$stmt3->execute();

$row = $stmt3->fetch(PDO::FETCH_ASSOC);
$home=$row["HSID"];
$away=$row["ASID"];
?>
<form action ="Selectplayers.php" method="POST" onsubmit="return validateForm()">
<?php 
echo("<input type='hidden'  name='FixID' value=".$row['FixtureID'].">");
?>
<h3>Players</h3><table style = "width:60%"  class="table-striped table-bordered table-condensed"><tr><th colspan="2">Home Players</th><th colspan="2">Away Players</th></tr>
    

    <tr>
    <td>Lady 1</td>
    <td><?php popdropdown($home,'F','homelady1');?></td>
    <td>Lady 1</td>
    <td><?php popdropdown($away,'F','awaylady1');?></td>
    </tr>

    <tr>
    <td>Lady 2</td>
    <td><?php popdropdown($home,'F','homelady2');?></td>
    <td>Lady 2</td>
    <td><?php popdropdown($away,'F','awaylady2');?></td>
    </tr>

    <tr>
    <td>Lady 3</td>
    <td><?php popdropdown($home,'F','homelady3');?></td>
    <td>Lady 3</td>
    <td><?php popdropdown($away,'F','awaylady3');?></td>
    </tr>
    <tr>
    <td>Man 1</td>
    <td><?php popdropdown($home,'M','homeman1');?></td>
    <td>Man 1</td>
    <td><?php popdropdown($away,'M','awayman1');?></td>
    </tr>

    <tr>
    <td>Man 2</td>
    <td><?php popdropdown($home,'M','homeman2');?></td>
    <td>Man 2</td>
    <td><?php popdropdown($away,'M','awayman2');?></td>
    </tr>

    <tr>
    <td>Man 3</td>
    <td><?php popdropdown($home,'M','homeman3');?></td>
    <td>Man 3</td>
    <td><?php popdropdown($away,'M','awayman3');?></td>
    </tr>
    <tr><td colspan="4"><input type="submit" value="Submit players"></td></tr>
    </table>

    
    </form>
    </body>
</html>
