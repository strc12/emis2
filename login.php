<!DOCTYPE html>
<html>
<head>
    
    <title>Login</title>
    
</head>
<body>

<form action="loginprocess.php" method= "POST">
<?php
echo '<input type="hidden" name="location" value="';
if(isset($_GET['location'])) {
    echo htmlspecialchars($_GET['location']);
}
echo '" />'
?>
  User name:<input type="text" name="Username"><br>
  Password:<input type="password" name="Pword"><br>
  
  <input type="submit" value="Login">
</form>


</body>
</html>