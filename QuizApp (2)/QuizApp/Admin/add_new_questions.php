<!DOCTYPE html>
<?php
include_once '../User/Header.php';
$query = 'select DISTINCT test_name from test1_table';

$statement = $conn->prepare($query);
$statement->execute();
$tests = $statement->fetchAll();

//http://php.net/manual/en/pdo.prepared-statements.php
if (isset($_POST['Add'])) {
    $qustn = $_POST['qustn'];
    $opt_1 = $_POST['option_1'];
    $opt_2 = $_POST['option_2'];
    $opt_3 = $_POST['option_3'];
    $opt_4 = $_POST['option_4'];
    $ans = $_POST['ans'];
    $select_opt = $_POST['test'];
   

    
      $query = 'INSERT INTO test1_table(questn,option_1,option_2,option_3,option_4,answer,test_name) VALUES(?,?,?,?,?,?,?)';
      $stmt = $conn->prepare($query);
     
      $stmt->bindParam(1, $qustn);
      $stmt->bindParam(2, $opt_1);
      $stmt->bindParam(3, $opt_2);
      $stmt->bindParam(4, $opt_3);
      $stmt->bindParam(5, $opt_4);
      $stmt->bindParam(6, $ans);
      $stmt->bindParam(7, $select_opt);

      if ($stmt->execute()) {
      echo "<script type='text/javascript'>
      alert('QUESTION ADDED SUCCESSFULLY');

      </script>";
      } else {
      echo "<script type='text/javascript'>
      alert('QUESTION NOT ADDED SUCCESSFULLY');

      </script>";
      } 
}

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
            <div class="column is-2">
                <label class="label">ADD NEW QUESTIONS</label>
            </div>



        </div>

        <div class="container column is-10">

            <form action="" method="post">



                <div class="card">
                    <div class="card-content"><div class="content">
                            <div class="columns is-multiline is-mobile">
                                <div class="column is-8">

                                    <div class="control">

                                        <input class="input" type="text" placeholder="Question" name="qustn" required >
                                    </div>
                                </div>
                                <div class="column is-2">
                                    <div class="control">
                                        <div class="select">
                                            <select  name="test" >
                                                <?php  foreach ($tests as $test) : ?>
                                                <option value="<?php echo $test['test_name']; ?>"><?php echo $test['test_name']; ?></option>
                                             
                                                 <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="column is-2">
                                    <p class="control" >
                                        <input type="submit" name="Add" class="button is-warning" value="Add">


                                    </p>
                                </div>


                            </div>



                        </div></div>
                    <div class="card-content"><div class="content">

                            <div class="columns is-multiline is-mobile">
                                <div class="column is-half">
                                    <div class="control">
                                        <label class="label">Option 1</label>
                                        <input class="input" type="text" placeholder="Option 1" name="option_1" required >
                                    </div>



                                </div>
                                <div class="column is-half">
                                    <div class="control">
                                        <label class="label">Option 2</label>
                                        <input class="input" type="text" placeholder="Option 2" name="option_2" required >
                                    </div>


                                </div>

                            </div>
                            <div class="columns is-multiline is-mobile">
                                <div class="column is-half">
                                    <label class="label">Option 3</label>
                                    <div class="control">
                                        <input class="input" type="text" placeholder="Option 3" name="option_3"  required >
                                    </div>




                                </div>
                                <div class="column is-half">
                                    <label class="label">Option 4</label>
                                    <div class="control">
                                        <input class="input" type="text" placeholder="Option 4" name="option_4" required >
                                    </div>


                                </div>
                            </div>


                        </div></div>
                    <footer class="card-footer">
                        <label class="label" id="answer_lbl">Answer:</label>
                        <div class="control">

                            <input class="input" type="text"id="answer_txt" placeholder="Answer" name="ans"  required >
                        </div>
                    </footer>
                </div>
                <br />

            </form>


            

        </div>
    </div>




</section>
<!-- End main section-->



<?php
include_once '../User/footer.php';
?>
