<?php

session_start();


if (!isset($_SESSION['name']))
{
    header("Location:index.php");
}

include_once ("connect.php");

?>

<!DOCTYPE html>
<html>
<head>
    
    <title>Change Password</title>
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
   function check(){
    var oldpw = document.getElementById('OldPword').value;
    var newpw = document.getElementById('NewPword').value;
    var newpw1 = document.getElementById('NewPword1').value;
    var span = document.getElementById('message');
    
    if(oldpw.length=0){
        document.getElementById('Change').disabled = true;
        while( span.firstChild ) {
            span.removeChild( span.firstChild );
        }
        span.appendChild(document.createTextNode("Enter Old password") );
        span.style.display = "block";
        return false;
    }else if(newpw!=newpw1){
        document.getElementById('Change').disabled = true;
        while( span.firstChild ) {
            span.removeChild( span.firstChild );
        }
        span.appendChild( document.createTextNode("Password do not match") );
        span.style.display = "block";
        return false;
    }else if(newpw.length<6){
        document.getElementById('Change').disabled = true;
        while( span.firstChild ) {
            span.removeChild( span.firstChild );
        }
        span.appendChild( document.createTextNode("Must be at least 6 characters long") );
        span.style.display = "block";
        return false;
    }else{
        document.getElementById('Change').disabled = false;
        span.style.display = "none";
        while( span.firstChild ) {
            span.removeChild( span.firstChild );
        }
        return true;
    }
   }
</script>
</head>
<body>


<div id="navigation"></div>
<div class="container-fluid" style="margin-top:10px">
    <form action="changepword.php" method= "POST"">
    <div class="form-group" style="width:50%">


    Old Password:<input class="form-control" type="password" id="OldPword"name="OldPword"><br>
    New Password:<input class="form-control" type="password" id="NewPword" name="NewPword" onkeyup='check();'><br>
    Confirm New Password:<input class="form-control" type="password" id="NewPword1" name="NewPword1" onkeyup='check();'><br>
    <span style="color:red; display:none" id='message'></span>
    <span style="color:red; display:none" id='CAPS'>WARNING! Caps lock is ON</span>
    </div>
    <input disabled=true class="btn btn-primary mb-2" type="submit" value="Change Password" id="Change">
    </form>
    </div>
</div>

<script>
    var oldpw = document.getElementById('OldPword');
    var newpw = document.getElementById('NewPword');
    var newpw1 = document.getElementById('NewPword1');
    var text= document.getElementById('CAPS');
    newpw.addEventListener("keyup", function(event) {

    if (event.getModifierState("CapsLock")) {
        text.style.display = "block";
    } else {
        text.style.display = "none"
    }
    });
    newpw1.addEventListener("keyup", function(event2) {

    if (event2.getModifierState("CapsLock")) {
 
        text.style.display = "block";
   
    } else {
        text.style.display = "none"
    }
    });
    oldpw.addEventListener("keyup", function(event3) {

    if (event3.getModifierState("CapsLock")) {
    
        text.style.display = "block";

    } else {
        text.style.display = "none"
    }
    });
 </script>
</body>
</html>