<?php
session_start();

if (!isset($_SESSION['name']))
{
    header("Location:login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
}

include_once ("connect.php");
array_map("htmlspecialchars", $_POST);
//create Players table
//print_r($_POST);
$hashed_password = password_hash($_POST["Pword"], PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO schools VALUES (NULL,:Schoolname,:Username,:Pword);" );
$stmt->bindParam(':Schoolname', $_POST['Schoolname']);
$stmt->bindParam(':Username', $_POST['Username']);
$stmt->bindParam(':Pword', $hashed_password);

$stmt->execute();
$conn=null;
header("Location:schools.php");
?>