<?php
 include 'Header.php';
 //logout.php  
 session_start(); 
 
$update_user_status_query = "UPDATE user set User_Status = 0 where User_email =?";
     
        
            
$user_status_update = $conn->prepare($update_user_status_query);
    

    
 $user_status_update->bindParam(1,  $_SESSION["User_email"]);
    

$user_status_update->execute();
 
 echo "session start";
 session_destroy();  
 echo "session destroyed";
 header("location:login.php");  
 ?> 