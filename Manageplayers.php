<?php
session_start();

if (!isset($_SESSION['name']))
{
  header("Location:index.php");
}
?>
<!DOCTYPE html>
<html>
<head>

    <title>Manage Players</title>

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
<script>
//Script calls Getresults.php passing the val from drop down to it PHP script creates visual of match results and them placed in results DIV
function showresult(str) {
    if (str == "") {
        document.getElementById("results").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("results").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getplayers.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
</head>
<body>
<div id="navigation"></div>
<div class="container-fluid" style="margin-top:10px">


    <div class="form-group" style="width:30%">
       School:<select id="matches" class="form-control"  onchange="showresult(this.value)">
       <option>Select School</option>
        <?php
        
        include_once ("connect.php");
        $stmt = $conn->prepare("SELECT  * FROM schools where Schoolname <>'admin';");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo("<option value=".$row["SchoolID"].'>'.$row["Schoolname"]."</option>");
        }

        ?>
         </select>
         
    </div>
    
    
</form>
</div>
<div id="results"></div>
</body>
<script>
$("#matches").on("change", function(){
    var selected=$(this).val();
    $("#results").html("You selected: " + selected);
  })</script>
</div>
</html>
