
<html>
<head>

    <title>Results</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
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
        xmlhttp.open("GET","Getresults.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
</head>
<body>
<form>
<label>Fixture: </label>
<select id="matches" onchange="showresult(this.value)">
    <option></option>select match</option>
   <?php
   include_once ("connect.php");
   $stmt = $conn->prepare("SELECT FixtureID,HomeID, AwayID, fixtdate, 
   awsc.Schoolname as AWS, hsch.Schoolname as HS, home.Division as hd, away.Division as ad FROM Fixtures 
   INNER JOIN Teams as home ON (Fixtures.HomeID = home.teamID) 
   INNER JOIN  Teams as away ON (Fixtures.AwayID=away.TeamID) 
   INNER JOIN Schools as awsc ON away.SchoolID=awsc.SchoolID 
   INNER JOIN Schools as hsch ON home.SchoolID=hsch.SchoolID 
   ORDER BY fixtdate ASC" );



   $stmt->execute();
   
   while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
   {
       //make into table at some point
       echo("<option value=".$row["FixtureID"].'>'.$row["HS"]." ".$row["hd"]." v ".$row["AWS"]." ".$row["ad"]." - ".$row["fixtdate"]."</option><br>");
   }
   $conn=null;
   ?>
    
    
</select>
</form>
<div id="results"></div>
<script>
$("#matches").on("change", function(){
    var selected=$(this).val();
    $("#results").html("You selected: " + selected);
  })</script>


</body>
</html>