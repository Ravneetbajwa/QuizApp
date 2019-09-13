<!DOCTYPE html>
<?php
include_once './Header.php';



$update_user_status_query = "UPDATE user set User_Status = 1 where User_email =?";
     
        
            
$user_status_update = $conn->prepare($update_user_status_query);
    

    
 $user_status_update->bindParam(1,  $_SESSION["User_email"]);
    

$user_status_update->execute();



?>


<head>
     <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Quiz mania</title>
        <link rel="shortcut icon" href="../images/logo1.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
        <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
   <!-- https://codepen.io/andreich1980/pen/OmobJQ -->
    <link rel="stylesheet" href="StyleSheets/question.css">
    <link rel="stylesheet" href="StyleSheets/navbar.css">
</head>
<body>

    <?php
    include_once './navbar.php';
    include_once './sideBar.php';
    ?>

    <div class="container column is-10" >
        <div class="section">
            <center>  <h1 class="title is-1">Welcome To Quiz Mania</h1></center></br>
            <h2 class="subtitle">Rules for the quiz:</h2>
            <p >
            <ol style="margin-left: 40px;">
                <li>
                    Appear For the test.
                </li>
                 <li>
                    Passed test can't be re taken.
                </li>
                <li>
                    You can appear for test for any number of times.
                </li>
                <li>
                    There is no time limit.
                </li>
            </ol>
            </p>
        </div>
    </div>
</section>


<?php
include_once './footer.php';
?>
    
