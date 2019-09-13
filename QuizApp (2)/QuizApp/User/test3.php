<!DOCTYPE html>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">


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
    }
}
?>
 <script type="text/javascript">

     var i = 0;
     
     
     
     
    
     function showHint() {
      alert("I am an alert box!");
       document.getElementById('qustn').innerHTML = <?php $questions[i][1]?>;
       document.getElementById('o_1').innerHTML = <?php $questions[i][2]?>;
       document.getElementById('o_2').innerHTML = <?php $questions[i][3]?>;
       document.getElementById('o_3').innerHTML = <?php $questions[i][4]?>;
       document.getElementById('o_4').innerHTML = <?php $questions[i][5]?>;
      // document.getElementById('data-here').innerHTML = typos[i][j];

       i++;

     }
   

   </script>


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
            
                <?php $i = 1; ?>
                


                    <div class="container column is-10">


                        <div class="card">
                            <div class="card-header"><p class="card-header-title" id="qustn"> Q <?php echo $i; ?> : </p></div>
                            <div class="card-content"><div class="content">
                                    <input type="hidden" id="qustnId" name="ans<?php echo $i; ?>" >
                                    <div class="columns is-multiline is-mobile">
                                        <div class="column is-half">


                                            <label class="radio">
                                                <input type="radio" name="answer<?php echo $i; ?>" id="o_1" >
                                                
                                            </label>

                                        </div>
                                        <div class="column is-half">

                                            <label class="radio">
                                                <input type="radio" name="answer<?php echo $i; ?>" id="o_2">
                                                
                                            </label>
                                        </div>

                                    </div>
                                    <div class="columns is-multiline is-mobile">
                                        <div class="column is-half">


                                            <label class="radio">
                                                <input type="radio" name="answer<?php echo $i; ?>"id="o_3">
                                                
                                            </label>

                                        </div>
                                        <div class="column is-half">
                                            <label class="radio">
                                                <input type="radio" name="answer<?php echo $i; ?>" id="o_4">
                                                
                                            </label>
                                        </div>
                                    </div>


                                </div></div>
                        </div>
                        <br />




                    </div>


                    <?php
                    $i++;
               ?>


                <div class="columns is-mobile is-centered">
                    <div class="column is-half is-narrow">
                        <p class="control" >
                            <button id='next'onclick="showHint()">next</button>
                           



                        </p>
                    </div>
                </div>
            


        </div>

    </section>




    <?php
    include_once './footer.php';
    ?>
    
