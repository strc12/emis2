<?php 
    // note this does not use connection.php as connection made at the time of creation
   $servername = 'localhost';
   $username = 'root';
   $password= '';
//note no Database mentioned here!!

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS emis";
    $conn->exec($sql);
    //next 3 lines optional only needed really if you want to go on an do more SQL here!
    $sql = "USE emis";
    $conn->exec($sql);
    echo "DB created successfully";
    //create Players table
    $stmt = $conn->prepare("DROP TABLE IF EXISTS players; 
    CREATE TABLE players (UserID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
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
     $stmt2 = $conn->prepare("DROP TABLE IF EXISTS teams;
    CREATE TABLE teams (TeamID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    SchoolID INT(2) NOT NULL,
    Division VARCHAR(1) NOT NULL);
    ");
    $stmt2->execute();
    $stmt2->closeCursor();
    echo ("Teams created<br>"); 
    //Create schools table ?Hash passwords?
     $stmt4 = $conn->prepare("DROP TABLE IF EXISTS schools;
    CREATE TABLE schools (SchoolID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Schoolname  VARCHAR(20) NOT NULL,
    Username VARCHAR(20) NOT NULL,
    Pword VARCHAR(200) NOT NULL,
    Teachername VARCHAR(60) NOT NULL);
    ");
    //must be 200 if hashed (128 bits via md5 hashing)
    $stmt4->execute();
    $stmt4->closeCursor(); 
    echo ("Schools created<br>");
    $stmt3 = $conn->prepare("DROP TABLE IF EXISTS fixtures;
    CREATE TABLE fixtures (fixtureID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Season VARCHAR(3),
    HomeID INT(4) NOT NULL,
    AwayID INT(4) NOT NULL,
    FixtDate DATE,
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
    M10A2 INT(2),
    ScoresEntered INT(1) NOT NULL DEFAULT 0);
    ");
    $stmt3->execute();
    $stmt3->closeCursor(); // allows query to complete
    echo ("Fixtures created<br>");
    $hashed_password = password_hash("squirt", PASSWORD_DEFAULT);
    $stmt5 = $conn->prepare("INSERT INTO schools VALUES (NULL,'admin','ric',:Pword,'admin');" );
    $stmt5->bindParam(':Pword', $hashed_password);
    $stmt5->execute();
    echo("admin user added<br>");
    $stmt5->closeCursor();

    $stmt6 = $conn->prepare("DROP TABLE IF EXISTS currentseason;
    CREATE TABLE currentseason (currentseason VARCHAR(3))");
    $stmt6->execute();
    echo("Currentseason added");
    $stmt6->closeCursor();

    $stmt8 = $conn->prepare("INSERT INTO currentseason VALUES ('x');" );
    $stmt8->execute();
    echo("dummy season created<br>");

    $stmt7 = $conn->prepare("DROP TABLE IF EXISTS seasonlist;
    CREATE TABLE seasonlist (seasoncode VARCHAR(3) PRIMARY KEY,
    seasonname varchar(20))");
    $stmt7->execute();
    echo("seasonlist added");
    $stmt7->closeCursor();
    }
catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }
$conn=null;

?>