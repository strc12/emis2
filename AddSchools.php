<?php
session_start();

if (!isset($_SESSION['name']))
{
    header("Location:login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
}

include_once ("connect.php");
array_map("htmlspecialchars", $_POST);

print_r($_POST);
$hashed_password = password_hash($_POST["Pword"], PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO Schools VALUES (NULL,:Schoolname,:Username,:Pword,:Teachername);" );
$stmt->bindParam(':Schoolname', $_POST['Schoolname']);
$stmt->bindParam(':Teachername', $_POST['Teachername']);
$stmt->bindParam(':Username', $_POST['Username']);
$stmt->bindParam(':Pword', $hashed_password);

$stmt->execute();
$conn=null;
header("Location:Schools.php");
?>
