<?php
$servername = "localhost";
$username = "mgs_user";
$password = "pa55word";

try {
    $conn = new PDO("mysql:host=$servername;dbname=quizapp", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>

