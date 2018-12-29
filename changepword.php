<?php
session_start();
$redirect = NULL;

if (!isset($_SESSION['name']))
{
    header("Location:login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
}

include_once ("connect.php");
array_map("htmlspecialchars", $_POST);
$attempt = $_POST["OldPword"];

$stmt = $conn->prepare("SELECT * FROM schools WHERE Username =:Username");
$stmt->bindParam(':Username', $_SESSION['name']);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$password=$row["Pword"];

if (password_verify($attempt,$password)){

    $hashed_password = password_hash($_POST["NewPword"], PASSWORD_DEFAULT);
    $stmt2 = $conn->prepare("UPDATE schools SET Pword=:pword WHERE SchoolID=:Scid");
    $stmt2->bindParam(':Scid', $row['SchoolID']);
    $stmt2->bindParam(':pword', $hashed_password);
    $stmt2->execute();
    $conn=null;
    header('Location: index.php');
}else{
    header("Location:changepassword.php");
}

?>
