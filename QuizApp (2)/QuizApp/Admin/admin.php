<!DOCTYPE html>
<?php
include_once '../User/Header.php';

//Online User Check

$query_online_user = "SELECT count( User_Status ) as online_users from user where User_Status = 1";

$user_online_count = $conn->prepare($query_online_user);

$user_online_count->execute();

$user_count = $user_online_count->fetchAll();




//min max score
$query = "SELECT test,MIN(score) AS SmallestScore , MAX(score) AS MaxScore FROM results group by test";

$statement = $conn->prepare($query);

$statement->execute();

$questions = $statement->fetchAll();


//average score
$q = "select test, AVG(Score)as avg From results group by test";
$statement1 = $conn->prepare($q);

$statement1->execute();

$questions1 = $statement1->fetchAll();


//failed user
$q1 = "select test,count(result_id) AS fail From results where status='FAILED' group by test";
$statement2 = $conn->prepare($q1);

$statement2->execute();

$questions2 = $statement2->fetchAll();


//PASSED user
$q2 = "select test,count(result_id)as pass From results where status='PASSED' group by test";
$statement3 = $conn->prepare($q2);

$statement3->execute();

$questions3 = $statement3->fetchAll();



?>
<head>
    <link rel="stylesheet" href="stylesheets/admin.css">
    <link rel="stylesheet" href="../User/StyleSheets/navbar.css">
</head>
<?php
include '../User/navbar.php';
?>

<!-- End navbar-->

<!-- main section started-->
<section class="section">
    <div class="container">
        <div class="columns is-mobile is-centered">
            <div class="column is-half is-narrow">
                <center><h1>Admin Panel</h1></center>





            </div>


        </div>
        <div class="columns">
            <div class="column is-5">
                <?php include_once './option_menu.php'; ?>
            </div>



        </div>
        <div class="container column is-10">

            <div class="tile is-ancestor">
                <div class="tile is-vertical is-12">
                    <div class="tile">
                        <div class="tile is-parent is-vertical">
                            <article class="tile is-child notification is-primary">
                                <p class="title">Highest Score</p>

                                <?php foreach ($questions as $question) : ?>
                                    <p class="subtitle"><?php echo $question['test'] . " : " . $question['MaxScore']; ?></p>

                                <?php endforeach; ?>
                            </article>
                            <article class="tile is-child notification is-warning">
                                <p class="title">Lowest Score</p>
                                <?php foreach ($questions as $question) : ?>
                                    <p class="subtitle"><?php echo $question['test'] . " : " . $question['SmallestScore']; ?></p>

                                <?php endforeach; ?>
                            </article>
                        </div>
                        <div class="tile is-parent is-vertical">
                            <article class="tile is-child notification is-primary">
                                <p class="title">Average Score</p>
                                <?php foreach ($questions1 as $question) : ?>
                                    <p class="subtitle"><?php echo $question['test'] . " : " . $question['avg']; ?></p>

                                <?php endforeach; ?>
                            </article>
                            <article class="tile is-child notification is-warning">
                                <p class="title">Total Pass</p>
                                <?php
                                if (sizeof($questions3, 1) == '0') {
                                    ?>
                                    <p class="subtitle"><?php echo "No Test"; ?></p>
                                    <?php
                                } else {
                                    // $pass_count =$statement3['pass'];


                                    foreach ($questions3 as $question) :
                                        ?>
                                        <p class="subtitle"><?php echo $question['test'] . " : " . $question['pass']; ?></p>

    <?php endforeach;
} ?>



                            </article>
                        </div>
                        <div class="tile is-parent is-vertical">
                            <article class="tile is-child notification is-primary">
                                <p class="title">Total Failed</p>
                                <?php
                                if (sizeof($questions2, 1) == '0') {
                                    ?>
                                    <p class="subtitle"><?php echo "No Test"; ?></p>
                                    <?php
                                } else {
                                    // $pass_count =$statement3['pass'];


                                    foreach ($questions2 as $question) :
                                        ?>
                                        <p class="subtitle"><?php echo $question['test'] . " : " . $question['fail']; ?></p>

                                    <?php endforeach;
                                } ?>

                            </article>
                            <article class="tile is-child notification is-warning">
                                <p class="title">Ongoing Test</p>
                                <p class="subtitle"><?php echo $user_count[0][0]?></p>
                            </article>
                        </div>
                    </div>

                </div>

            </div>





        </div>
    </div>
</div>



</section>
<!-- End main section-->

<?php
include_once '../User/footer.php';
?>
