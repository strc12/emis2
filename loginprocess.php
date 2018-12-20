<?php
session_start();
$redirect = NULL;
if($_POST['location'] != '') {
    $redirect = $_POST['location'];
}
include_once ("connect.php");
array_map("htmlspecialchars", $_POST);
//print_r($_POST);




$stmt = $conn->prepare("SELECT * FROM schools WHERE Username =:username ;" );
$stmt->bindParam(':username', $_POST['Username']);

$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    $hashed= $row['Pword'];
    $attempt= $_POST['Pword'];
    if(password_verify($attempt,$hashed)){
        $_SESSION['name']=$row["Username"];
        $_SESSION['Teachername']=$row["Teachername"];
        $_SESSION['SchoolID']=$row["SchoolID"];
        header('Location: '.$redirect);
    }else{
        header('Location: index.php');
    }
}
$conn=null;
header('Location: index.php');
?>
