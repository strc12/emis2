<?php
session_start();

include "setseason.php";
?>
<!DOCTYPE html>
<html>
<head>

    <title>Legacy stats</title>
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
<h3>Archive search</h3>

<form action ="<?php echo $_SERVER['PHP_SELF'];?>" method ="POST">
season: <select name = "filterseason">
<option value ="" selected disabled>Please select a season...</option>
    <?php
    include_once ("connect.php");
    $stmt = $conn->prepare("SELECT Distinct season FROM `archive players`;");
    $stmt->execute();
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<option value='" . $row['season'] . "'>" . $row['season'] ." </option>";
    }
    echo '</select> <br><br>';
    
    ?>
<input type='submit' name='btnplayers' value='Players'/>
<input type='submit' name='btnleagues' value='Leagues'/>
</form>
<?php
// Showing and filtering data according to user-defined filters
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if (isset ($_POST['btnplayers'])){
         if (isset($_POST['filterseason'])){
    

        $seasonselection=$_POST['filterseason'];
        echo $seasonselection ." Players in rank order";
    
        echo '<table class="table-striped table-bordered table-condensed" >';
        echo '<tr>';
        echo '<th>Position</th>';
        echo '<th>Player Name</th>';
        echo '<th>Win Percentage</th>';
        echo '<th>Games won</th>';
        echo '<th>Games Lost</th>';
        echo '<th>Points for</th>';
        echo '<th>Points against</th>';
        echo '<th>Average points difference</th>';
        echo '</tr>';
        $count = 0;

        $stmt1 = $conn->prepare("SELECT * from `archive players` where ((gameswon+gameslost)>0 and (season='$seasonselection')) order by (gameswon/(gameswon+gameslost)) desc,((pointswon-pointslost)/(gameswon+gameslost)) desc");
        $stmt1->execute();
        
        while ($rows = $stmt1->fetch(PDO::FETCH_ASSOC)){

            $count = $count + 1;
            echo '<tr>';
            echo '<td>' . $count . '</td>';
            echo "<td>" . $rows['firstname'] . " " . $rows['lastname'] . " (" . $rows['school'] . ")</td>";
            if(($rows['gameswon'] +$rows['gameslost'] )==0){
                echo("<td>0%</td>");
            }else{
                    echo("<td>".$percent=round((($rows['gameswon'] /($rows['gameswon'] +$rows['gameslost'] ))*100),2)."%</td>");
            }
            //$percent=round((($rows['gameswon'] /($rows['gameswon'] +$rows['gameslost'] ))*100),2);
            
            echo "<td>" . $rows['gameswon'] . "</td>";
            echo "<td>" . $rows['gameslost'] . "</td>";
            echo "<td>" . $rows['pointswon'] . "</td>";
            echo "<td>" . $rows['pointslost'] . "</td>";
            if(($rows['gameswon'] +$rows['gameslost'] )==0){
                echo("<td>0%</td>");
            }else{
            $pointsdiff=round(((($rows['pointswon']-$rows['pointslost']) /($rows['gameswon'] +$rows['gameslost'] ))),2);
            echo "<td>" . $pointsdiff. "</td>";
            }
            echo '</tr>';
                
            }
        
        }
    }
    else{
        if (isset($_POST['filterseason'])){
      include 'connect.php';
        $seasonselection=$_POST['filterseason'];
        echo "<h3>".$seasonselection ." Leagues</h3>";
        echo '<table style="width:50%">';
        echo '<tr>';
        echo '<th>Position</th>';
        echo '<th>Team Name</th>';
        echo '<th>Games played</th>';
        echo '<th>Games Won</th>';
        echo '<th>Games Lost</th>';
        echo '<th>Points for</th>';
        echo '<th>Poinst against</th>';
        echo '</tr>';

        $Acount = 0;

        $stmt2 = $conn->prepare("SELECT * from `archive team` where (league = 'A' and season='$seasonselection') order by gameswon desc");
        $stmt2->execute();
    
        while ($Arows = $stmt2->fetch(PDO::FETCH_ASSOC)){
            $Acount = $Acount + 1;
            echo '<tr>';
            echo '<td>' . $Acount . '</td>';
            echo '<td>' . $Arows['name'] . '</td>';
            echo '<td>' . $Arows['matchesplayed'] . '</td>';
            echo '<td>' . $Arows['gameswon'] . '</td>';
            echo '<td>' . $Arows['gameslost'] . '</td>';
            echo '<td>' . $Arows['pointswon'] . '</td>';
            echo '<td>' . $Arows['pointslost'] . '</td>';
            echo '</tr>';

        }
        
        echo '</table>';
        echo '<ins>Teams League B Table</ins><br>';
        echo '<table style="width:50%">';
        echo '<tr>';
        echo '<th>Position</th>';
        echo '<th>Team Name</th>';
        echo '<th>Games played</th>';
        echo '<th>Games Won</th>';
        echo '<th>Games Lost</th>';
        echo '<th>Points for</th>';
        echo '<th>Poinst against</th>';
        echo '</tr>';

        $Bcount = 0;

        $stmt3 = $conn->prepare("SELECT * from `archive team` where league ='B' and season='$seasonselection' order by gameswon desc");
        $stmt3->execute();
    
        while ($Brows = $stmt3->fetch(PDO::FETCH_ASSOC)){
            $Bcount = $Bcount + 1;
            echo '<tr>';
            echo '<td>' . $Bcount . '</td>';
            echo '<td>' . $Brows['name'] . '</td>';
            echo '<td>' . $Brows['matchesplayed'] . '</td>';
            echo '<td>' . $Brows['gameswon'] . '</td>';
            echo '<td>' . $Brows['gameslost'] . '</td>';
            echo '<td>' . $Brows['pointswon'] . '</td>';
            echo '<td>' . $Brows['pointslost'] . '</td>';
            echo '<tr>';
          }

    }
    }
}
?>


</div>
</body>
</html>