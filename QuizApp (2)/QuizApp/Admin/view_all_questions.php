<!DOCTYPE html>
<?php
include_once '../User/Header.php';

if (isset($_POST['Update']) || isset($_POST['Delete'])) {
    $qustnid = $_POST['qustnId'];
    $qustn = $_POST['qustn'];
    $optn1 = $_POST['optn_1'];
    $optn2 = $_POST['optn_2'];
    $optn3 = $_POST['optn_3'];
    $optn4 = $_POST['optn_4'];
    $ans = $_POST['ans'];
    $test_name=$_POST['test_name'];



    if (isset($_POST['Update'])) {


       
        $query = "UPDATE test1_table SET questn=?, option_1=?,option_2=?,option_3=?,option_4=? ,answer=?, test_name=? WHERE qustn_id=?";
        $stmt = $conn->prepare($query);

        
        if ($stmt->execute([$qustn, $optn1, $optn2, $optn3, $optn4, $ans,$test_name, $qustnid])) {
            echo "<script type='text/javascript'>
      alert('QUESTION UPDATED SUCCESSFULLY');

      </script>";
        } else {
            echo "<script type='text/javascript'>
      alert('QUESTION NOT UPDATED');

      </script>";
        }
    }
    if (isset($_POST['Delete'])) {
        $sql = "DELETE FROM test1_table WHERE qustn_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $qustnid);
        if ($stmt->execute()) {

            echo "<script type='text/javascript'>
      alert('QUESTION DELETED SUCCESSFULLY');

      </script>";
        } else {
            echo "<script type='text/javascript'>
      alert('QUESTION NOT DELETED');

      </script>";
        }
    }
}
$query = 'select * from test1_table';
$statement = $conn->prepare($query);
$statement->execute();
$questions = $statement->fetchAll();
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
                <label class="label">ALL QUESTIONS</label>
            </div>
          
         



        </div>
         

        <?php foreach ($questions as $question) : ?>


            <form action="view_all_questions.php" method="post">
                <div class="container column is-10">

                    <div class="card">
                        <div class="card-content"><div class="content">
                                <div class="columns is-multiline is-mobile">
                                    <div class="column is-8">

                                        <div class="control">
                                            <input type="hidden" id="qustnId" name="qustnId" value="<?php echo $question['qustn_id']; ?>">
                                            <label class="label">Question <?php echo $question['qustn_id'] ?></label>
                                            <input class="input" type="text" name="qustn" placeholder="Question" value="<?php echo $question['questn']; ?>" required >
                                        </div>
                                    </div>
                                    <div class="column is-2">
                                        <p class="control" >
                                            <button type="submit" name="Update" class="button is-warning" >Update </button>
                                          
                                        </p>
                                    </div>
                                    <div class="column is-2">
                                        <p class="control" >

                                            <button type="submit" name="Delete" class="button is-danger" >Delete </button>



                                        </p>
                                    </div>
                                  
                                </div>
                                  <div class="columns is-multiline is-mobile">
                                      <div class="column is-8">
                                           <div class="control">
                                            <label class="label">Test Name</label>
                                            <input class="input" type="text" name="test_name" placeholder="Test name" value=" <?php echo $question['test_name'] ?>" required >
                                        </div>
                                      </div>
                                  </div>
                                <div class="columns is-multiline is-mobile">
                                    <div class="column is-half">
                                        <div class="control">
                                            <label class="label">Option 1</label>
                                            <input class="input" type="text" name="optn_1" placeholder="Question" value=" <?php echo $question['option_1'] ?>" required >
                                        </div>



                                    </div>
                                    <div class="column is-half">
                                        <div class="control">
                                            <label class="label">Option 2</label>
                                            <input class="input" type="text" name="optn_2" placeholder="Question" value=" <?php echo $question['option_2'] ?>" required >
                                        </div>


                                    </div>

                                </div>
                                <div class="columns is-multiline is-mobile">
                                    <div class="column is-half">
                                        <label class="label">Option 3</label>
                                        <div class="control">
                                            <input class="input" type="text" name="optn_3" placeholder="Question" value=" <?php echo $question['option_3'] ?>" required >
                                        </div>




                                    </div>
                                    <div class="column is-half">
                                        <label class="label">Option 4</label>
                                        <div class="control">
                                            <input class="input" type="text" name="optn_4" placeholder="Question" value=" <?php echo $question['option_4'] ?>" required >
                                        </div>


                                    </div>
                                </div>


                            </div></div>
                        <footer class="card-footer">
                            <label class="label" id="answer_lbl">Answer:</label>
                            <div class="control">

                                <input class="input" type="text"id="answer_txt" name="ans" placeholder="Answer" value=" <?php echo $question['answer'] ?>" required >
                            </div>
                        </footer>
                    </div>
                    <br />
                </div>
            </form>
        <?php endforeach; ?>






    </div>
</div>



</section>
<!-- End main section-->

<?php
include_once '../User/footer.php';
?>
