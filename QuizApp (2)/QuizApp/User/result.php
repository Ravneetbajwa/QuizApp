<!DOCTYPE html>
<?php
include_once './Header.php';?>


<?php
date_default_timezone_set('America/Toronto');
 $date_clicked = date('H:i:s');

        $before = strtotime($_SESSION['now']);
        $after = strtotime($date_clicked);
        $diff = $after - $before;

        $hours = floor($diff / 3600);
        $minutes = floor(($diff - $hours * 3600) / 60);
        $seconds = $diff - $hours * 3600 - $minutes * 60;
         $_SESSION['date'] = date("d-m-Y");
        $_SESSION['time_taken'] = sprintf("%02uh %02um %02us", $hours, $minutes, $seconds);

     

        //INSERTING DATA
        $query = 'INSERT INTO results (user,test,time,time_taken,date,status,score) VALUES(?,?,?,?,?,?,?)';
        $stmt = $conn->prepare($query);

        $stmt->bindParam(1, $_SESSION['User_email']);
        $stmt->bindParam(2, $_SESSION['test_result_name']);
        $stmt->bindParam(3, $_SESSION['now']);
        $stmt->bindParam(4, $_SESSION['time_taken']);
        $stmt->bindParam(5, $_SESSION['date']);
        $stmt->bindParam(6, $_SESSION['status']);
        $stmt->bindParam(7, $_SESSION['correctans']);

        if ($stmt->execute()) {
            echo "<script type='text/javascript'>
      alert('TEST SUBMITTED SUCCESSFULLY');

      </script>";
        } else {
            echo "<script type='text/javascript'>
      alert('TEST NOT SUBMITTED SUCCESSFULLY');

      </script>";
        }
    

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
    ;
    ?>

    <div class="container column is-10" >
        <div class="section">
            <div class="card">
                <div class="card-header"><p class="card-header-title">Result</p></div>
                <div class="card-content">
                    <div class="content">
                        <div class="columns">
                            <div class="column is-two-fifths">
                                <label class="label"> Correct Answers: </label><br>
                                <label class="label"> Wrong Answers: </label><br>
                                <label class="label"> Not Attempted: </label><br>
                                <label class="label"> Time Taken: </label><br>

                            </div>
                            <div class="column">
                                <label class="label" id="c_ans">  </label><br>
                                <label class="label" id="w_ans">  </label><br>
                                <label class="label" id="b_ans">  </label><br>
                                <label class="label"> <?php printf("%02uh %02um %02us <br>\n", $hours, $minutes, $seconds); ?> </label><br>
                            </div>

                        </div>

                    </div>

                </div>
                <div class="card-footer"><p class="card-footer-title" id="message"></p></div>
            </div>
            <br />
        </div>
        <center><a class="button is-success" href="question.php">Exit</a></center>
    </div>

<script>
 var x = localStorage.getItem("correct_ans");
 var y = localStorage.getItem("wrong_ans");
 var z = localStorage.getItem("skipped_ans");
 document.getElementById("c_ans").innerHTML = x;
 document.getElementById("w_ans").innerHTML = y;
 document.getElementById("b_ans").innerHTML = z;
  console.log(x);
  console.log(y);
  console.log(z);
  if(x<8)
  {
     document.getElementById("message").innerHTML = 'Unfortunately you did not pass the test. Please try again later!';
     var status = 'FAILED';
  }
  else
  {
     document.getElementById("message").innerHTML ='You have successfully passed the test. You are now certified in Quizmaia Test 1.” Where Sports is the certification topic you have chosen for this assignment.';
     var status = 'PASSED';
  }
</script>

    <?php
    include_once './footer.php';
    ?>
    
