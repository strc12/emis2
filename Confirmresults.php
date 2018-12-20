<?php
session_start();
header("Location: index.php");
include "setseason.php";
if (!isset($_SESSION['name']))
{
    header("Location:login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
}
include_once ("connect.php");
array_map("htmlspecialchars", $_POST);
print_r($_POST);
$stmt = $conn->prepare("UPDATE fixtures set 
M1H1=:m1h1,M2H1=:m2h1,M3H1=:m3h1,M3H2=:m3h2,M4H1=:m4h1,M4H2=:m4h2,M5H1=:m5h1,M5H2=:m5h2,M6H1=:m6h1,M6H2=:m6h2,
M7H1=:m7h1,M7H2=:m7h2,M8H1=:m8h1,M8H2=:m8h2,M9H1=:m9h1,M9H2=:m9h2,M10H1=:m10h1,M10H2=:m10h2,
M1A1=:m1a1,M2A1=:m2a1,M3A1=:m3a1,M3A2=:m3a2,M4A1=:m4a1,M4A2=:m4a2,M5A1=:m5a1,M5A2=:m5a2,M6A1=:m6a1,M6A2=:m6a2,
M7A1=:m7a1,M7A2=:m7a2,M8A1=:m8a1,M8A2=:m8a2,M9A1=:m9a1,M9A2=:m9a2,M10A1=:m10a1,M10A2=:m10a2, ScoresEntered=1
 WHERE FixtureID=:fid");
$stmt->bindParam(':fid', $_POST["FixID"]);
$stmt->bindParam(':m1h1', $_POST["m1hpts"]);
$stmt->bindParam(':m2h1', $_POST["m2hpts"]);
$stmt->bindParam(':m3h1', $_POST["m3hpts"]);
$stmt->bindParam(':m3h2', $_POST["m3ahpts"]);
$stmt->bindParam(':m4h1', $_POST["m4hpts"]);
$stmt->bindParam(':m4h2', $_POST["m4ahpts"]);
$stmt->bindParam(':m5h1', $_POST["m5hpts"]);
$stmt->bindParam(':m5h2', $_POST["m5ahpts"]);
$stmt->bindParam(':m6h1', $_POST["m6hpts"]);
$stmt->bindParam(':m6h2', $_POST["m6ahpts"]);
$stmt->bindParam(':m7h1', $_POST["m7hpts"]);
$stmt->bindParam(':m7h2', $_POST["m7ahpts"]);
$stmt->bindParam(':m8h1', $_POST["m8hpts"]);
$stmt->bindParam(':m8h2', $_POST["m8ahpts"]);
$stmt->bindParam(':m9h1', $_POST["m9hpts"]);
$stmt->bindParam(':m9h2', $_POST["m9ahpts"]);
$stmt->bindParam(':m10h1', $_POST["m10hpts"]);
$stmt->bindParam(':m10h2', $_POST["m10ahpts"]);
$stmt->bindParam(':m1a1', $_POST["m1apts"]);
$stmt->bindParam(':m2a1', $_POST["m2apts"]);
$stmt->bindParam(':m3a1', $_POST["m3apts"]);
$stmt->bindParam(':m3a2', $_POST["m3aapts"]);
$stmt->bindParam(':m4a1', $_POST["m4apts"]);
$stmt->bindParam(':m4a2', $_POST["m4aapts"]);
$stmt->bindParam(':m5a1', $_POST["m5apts"]);
$stmt->bindParam(':m5a2', $_POST["m5aapts"]);
$stmt->bindParam(':m6a1', $_POST["m6apts"]);
$stmt->bindParam(':m6a2', $_POST["m6aapts"]);
$stmt->bindParam(':m7a1', $_POST["m7apts"]);
$stmt->bindParam(':m7a2', $_POST["m7aapts"]);
$stmt->bindParam(':m8a1', $_POST["m8apts"]);
$stmt->bindParam(':m8a2', $_POST["m8aapts"]);
$stmt->bindParam(':m9a1', $_POST["m9apts"]);
$stmt->bindParam(':m9a2', $_POST["m9aapts"]);
$stmt->bindParam(':m10a1', $_POST["m10apts"]);
$stmt->bindParam(':m10a2', $_POST["m10aapts"]);

$stmt->execute();
$conn=null;
$_SESSION["fid"]=$_POST["FixID"];
echo $_SESSION["fid"];


?>