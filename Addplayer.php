
<?php
session_start();

if (!isset($_SESSION['name']))
{
    header("Location:login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
}

include_once ("connect.php");
array_map("htmlspecialchars", $_POST);
print_r($_POST);
$stmt = $conn->prepare("INSERT INTO players (UserID,Gender,Surname,Forename,School, Active)VALUES(NULL,:Gender,:Surname,:Forename,:School,1)");
$stmt->bindParam(':Forename', $_POST["forename"]);
$stmt->bindParam(':Surname', $_POST["surname"]);
$stmt->bindParam(':School', $_POST["SchoolID"]);
$stmt->bindParam(':Gender', $_POST["gender"]);

$stmt->execute();
header("Location:Players.php");
?>
