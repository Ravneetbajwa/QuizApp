<!DOCTYPE html>
<?php
include_once './Header.php';

date_default_timezone_set('America/Toronto');
$now = date('H:i:s');
$_SESSION['now'] = $now;

if (isset($_GET['testno'])) {
    $sql = "Select status from results where user=? and test=?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $_SESSION['User_email']);
    $stmt->bindParam(2, $_GET['testno']);
    $stmt->execute();
    $status = $stmt->fetchAll();
   
    
   if ($status[0]['status']=='PASSED') {
        echo "<script type='text/javascript'>
      alert('YOU HAVE ALREADY PASSED THE TEST :)');
      window.location.href='question.php';

      </script>";
    } else {
        $query = 'SELECT * FROM test1_table where test_name=? order by RAND() LIMIT 10';
        $statement = $conn->prepare($query);
        $statement->bindParam(1, $_GET['testno']);
        $statement->execute();
        $questions = $statement->fetchAll();
        $_SESSION['test_result_name']=$_GET['testno'];
        echo'<pre>';
        print_r($questions);
        echo'</pre>';
    }
}
?>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz mania</title>
    <link rel="shortcut icon" href="../images/logo1.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <!--https://codepen.io/andreich1980/pen/OmobJQ-->
    <link rel="stylesheet" href="StyleSheets/question.css">
    <link rel="stylesheet" href="StyleSheets/navbar.css">
</head>
<body>

    <?php
    include_once './navbar.php';
    include_once './sideBar.php';
    ?>
    <section class="section">
        <div class="container">
            <form action="result.php" method="post">
                <?php $i = 1; ?>
                <?php foreach ($questions as $question) : ?>


                    <div class="container column is-10">


                        <div class="card">
                            <div class="card-header"><p class="card-header-title"> Q <?php echo $i; ?> : <?php echo $question['questn']; ?></p></div>
                            <div class="card-content"><div class="content">
                                    <input type="hidden" id="qustnId" name="ans<?php echo $i; ?>" value="<?php echo $question['answer']; ?>">
                                    <div class="columns is-multiline is-mobile">
                                        <div class="column is-half">


                                            <label class="radio">
                                                <input type="radio" name="answer<?php echo $i; ?>" value="<?php echo $question['option_1'] ?>" >
                                                <?php echo $question['option_1'] ?>
                                            </label>

                                        </div>
                                        <div class="column is-half">

                                            <label class="radio">
                                                <input type="radio" name="answer<?php echo $i; ?>" value="<?php echo $question['option_2'] ?>">
                                                <?php echo $question['option_2'] ?>
                                            </label>
                                        </div>

                                    </div>
                                    <div class="columns is-multiline is-mobile">
                                        <div class="column is-half">


                                            <label class="radio">
                                                <input type="radio" name="answer<?php echo $i; ?>" value="<?php echo $question['option_3'] ?>">
                                                <?php echo $question['option_3'] ?>
                                            </label>

                                        </div>
                                        <div class="column is-half">
                                            <label class="radio">
                                                <input type="radio" name="answer<?php echo $i; ?>" value="<?php echo $question['option_4'] ?>">
                                                <?php echo $question['option_4'] ?>
                                            </label>
                                        </div>
                                    </div>


                                </div></div>
                        </div>
                        <br />




                    </div>


                    <?php
                    $i++;
                endforeach;
                ?>


                <div class="columns is-mobile is-centered">
                    <div class="column is-half is-narrow">
                        <p class="control" >
                            <input type="submit" name="save" class="button is-success" value="Save">
                           



                        </p>
                    </div>
                </div>
            </form>


        </div>

    </section>




    <?php
    include_once './footer.php';
    ?>
    
