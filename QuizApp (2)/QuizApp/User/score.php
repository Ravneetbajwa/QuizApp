<!DOCTYPE html>
<?php
include_once './Header.php';

$query = 'select * from results where user=? order by date';

$statement = $conn->prepare($query);
$statement->bindParam(1,$_SESSION['User_email']);
$statement->execute();
$history = $statement->fetchAll();
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
     
    <div class="container column is-10" style="margin-top: 4%;">
     <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Test Name</th>

                            <th>Time</th>
                             <th>Time Taken</th>
                            <th>Date</th>
                           
                            <th>Score</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <?php
                    $i = 1;
                    foreach ($history as $historys) :
                        ?>
                        <tbody>
                            <tr>
                                <th><?php echo $i; ?></th>
                                <td><?php echo $historys['test']; ?>
                                </td>
                                <td><?php echo $historys['time']; ?></td>
                                <td><?php echo $historys['time_taken']; ?></td>
                                <td><?php echo $historys['date']; ?></td>
                                <td><?php echo $historys['score']; ?></td>
                                <td><?php echo $historys['status']; ?></td>

                            </tr>



                        </tbody>
                        <?php
                        $i++;
                    endforeach;
                    ?>
                </table>
    </div>
</section>
    

<?php
include_once './footer.php';
?>
    
