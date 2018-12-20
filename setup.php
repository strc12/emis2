<?php
include_once ("connect.php");
//create Players table
$stmt = $conn->prepare("DROP TABLE IF EXISTS Players; 
CREATE TABLE Players (UserID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Gender VARCHAR(1) NOT NULL,
Surname VARCHAR(20) NOT NULL,
Forename VARCHAR(20) NOT NULL,
School INT(4) NOT NULL,
Active TINYINT(1) NOT NULL);
");
$stmt->execute();
$stmt->closeCursor();
echo ("Players created<br>");
//create Teams table 
$stmt2 = $conn->prepare("DROP TABLE IF EXISTS Teams;
CREATE TABLE Teams (TeamID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
SchoolID INT(2) NOT NULL,
Division VARCHAR(1) NOT NULL);
");
$stmt2->execute();
$stmt2->closeCursor();
echo ("Teams created<br>");
//Create schools table ?Hash passwords?
$stmt4 = $conn->prepare("DROP TABLE IF EXISTS Schools;
CREATE TABLE Schools (SchoolID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Schoolname  VARCHAR(20) NOT NULL,
Username VARCHAR(20) NOT NULL,
Pword VARCHAR(60) NOT NULL);
");
//must be 60 if hashed
$stmt4->execute();
$stmt4->closeCursor();
echo ("Schools created<br>");
$stmt3 = $conn->prepare("DROP TABLE IF EXISTS Fixtures;
CREATE TABLE Fixtures (FixtureID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
HomeID INT(4) NOT NULL,
AwayID INT(4) NOT NULL,
FixtDate DATE NOT NULL,
HM1ID INT(4),
HM2ID INT(4),
HM3ID INT(4),
HL1ID INT(4),
HL2ID INT(4),
HL3ID INT(4),
AM1ID INT(4),
AM2ID INT(4),
AM3ID INT(4),
AL1ID INT(4),
AL2ID INT(4),
AL3ID INT(4),
M1H1 INT(2),
M1A1 INT(2),
M2H1 INT(2),
M2A1 INT(2),
M3H1 INT(2),
M3H2 INT(2),
M3A1 INT(2),
M3A2 INT(2),
M4H1 INT(2),
M4H2 INT(2),
M4A1 INT(2),
M4A2 INT(2),
M5H1 INT(2),
M5H2 INT(2),
M5A1 INT(2),
M5A2 INT(2),
M6H1 INT(2),
M6H2 INT(2),
M6A1 INT(2),
M6A2 INT(2),
M7H1 INT(2),
M7H2 INT(2),
M7A1 INT(2),
M7A2 INT(2),
M8H1 INT(2),
M8H2 INT(2),
M8A1 INT(2),
M8A2 INT(2),
M9H1 INT(2),
M9H2 INT(2),
M9A1 INT(2),
M9A2 INT(2),
M10H1 INT(2),
M10H2 INT(2),
M10A1 INT(2),
M10A2 INT(2));
Played INT(1) NOT NULL DEFAULT (0);
ScoresEntered INT(1) NOT NULL DEFAULT(0);
");
$stmt3->execute();
$stmt3->closeCursor(); // allows query to complete
echo ("Fixtures created<br>");
$hashed_password = password_hash("squirt", PASSWORD_DEFAULT);
$stmt4 = $conn->prepare("INSERT INTO Schools VALUES (NULL,Oundle,ric,:Pword,Rob);" );
$stmt4->bindParam(':Pword', $hashed_password);
$stmt4->execute();
echo("user added");
$conn=null;

?>