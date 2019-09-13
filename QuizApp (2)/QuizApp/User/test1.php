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


    if ($status[0]['status'] == 'PASSED') {
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
        $_SESSION['test_result_name'] = $_GET['testno'];
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script type="text/javascript">



        var i = 0;
        var correct_ans = 0;
        var wrong_ans = 0;
        var skipped_ans = 0;



        function name111() {

            var question_string = <?php echo '' . json_encode($questions); ?>;




//         alert("hi");
            console.log("I : " + i);




//         console.log(question_string[i]);

            if (i < 11) {


                var ans_index = 0;
                if (i != 0) {
                    ans_index = i - 1;
                }

                var selected_ans = "";
                var answer = question_string[ans_index]["answer"];

                if (document.getElementById("o_1").checked) {

                    selected_ans = document.getElementById("o_1").val;
                }
                else if (document.getElementById("o_2").checked) {

                    selected_ans = document.getElementById("o_2").val;
                }
                else if (document.getElementById("o_3").checked) {

                    selected_ans = document.getElementById("o_3").val;
                }
                else if (document.getElementById("o_4").checked) {

                    selected_ans = document.getElementById("o_4").val;
                }
                else {

                    selected_ans = "";

                }


                console.log("selected Answer : " + selected_ans);
                console.log("Answer : " + answer);


                if (selected_ans == "") {

                    skipped_ans++;

                } else {

                    if (selected_ans == answer) {

                        correct_ans++;

                    } else {

                        wrong_ans++;

                    }

                }

                if (i == 0) {

                    skipped_ans = 0;

                }

            }

            if (i < 10) {



//            console.log(question_string[i][1]);
                document.getElementById("qustn").innerHTML = "Q" + (i + 1) + " : " + question_string[i]["questn"];
                document.getElementById("o_1").val = question_string[i]["option_1"];
                document.getElementById("o_2").val = question_string[i]["option_2"];
                document.getElementById("o_3").val = question_string[i]["option_3"];
                document.getElementById("o_4").val = question_string[i]["option_4"];

                document.getElementById("op_1").innerHTML = question_string[i]["option_1"];
                document.getElementById("op_2").innerHTML = question_string[i]["option_2"];
                document.getElementById("op_3").innerHTML = question_string[i]["option_3"];
                document.getElementById("op_4").innerHTML = question_string[i]["option_4"];




                document.getElementById("o_1").checked = false;
                document.getElementById("o_2").checked = false;
                document.getElementById("o_3").checked = false;
                document.getElementById("o_4").checked = false;


                console.log("Correct Ans : " + correct_ans);
                console.log("Wrong Ans : " + wrong_ans);
                console.log("Skipped Ans : " + skipped_ans);


            }
            else {

                console.log("Correct Ans : " + correct_ans);
                console.log("Wrong Ans : " + wrong_ans);
                console.log("Skipped Ans : " + skipped_ans);

                localStorage.setItem("correct_ans", correct_ans);
                localStorage.setItem("wrong_ans", wrong_ans);
                localStorage.setItem("skipped_ans", skipped_ans);


            }
            i++;
        }



        $(document).ready(function() {

            name111();

        });

        function calculateResult() {


        }


    </script>


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
                                        <label id = "op_1"></label>

                                    </label>

                                </div>
                                <div class="column is-half">

                                    <label class="radio">
                                        <input type="radio" name="answer<?php echo $i; ?>" id="o_2">
                                        <label id = "op_2"></label>

                                    </label>
                                </div>

                            </div>
                            <div class="columns is-multiline is-mobile">
                                <div class="column is-half">


                                    <label class="radio">
                                        <input type="radio" name="answer<?php echo $i; ?>"id="o_3">
                                        <label id = "op_3"></label>

                                    </label>

                                </div>
                                <div class="column is-half">
                                    <label class="radio">
                                        <input type="radio" name="answer<?php echo $i; ?>" id="o_4">
                                        <label id = "op_4"></label>

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
                        <button id='next'onclick="name111()">next</button>




                    </p>
                </div>
            </div>



        </div>

    </section>




    <?php
    include_once './footer.php';
    ?>
    
