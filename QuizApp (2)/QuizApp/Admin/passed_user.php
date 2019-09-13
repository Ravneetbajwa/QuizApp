<!DOCTYPE html>
<?php
include_once '../User/Header.php';

if ($_POST['test'] == 'test2_table') {
    $query = 'select * from results where test = "Test 2" AND status="PASSED"';
} else {
    $query = 'select * from results where test = "Test 1" AND status="PASSED"';
}



$statement = $conn->prepare($query);
$statement->execute();
$row = $statement->fetchAll();

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
            <div class="column is-5">
                <label class="label"> PASSED USERS</label>
            </div>



        </div>
        <form  method="post">
            <div class="column is-2">
                <div class="control">
                    <div class="select">
                        <select id="name"  name="test" onchange="this.form.submit()">

                             <option value="test1_table" <?php if (isset($_POST['test']) && $_POST['test']=="test1_table") echo "selected";?>>Test 1</option>
                            <option value="test2_table" <?php if (isset($_POST['test']) && $_POST['test']=="test2_table") echo "selected";?>>Test 2</option>

                            <script type="text/javascript">
                                document.getElementById('name').value = "<?php echo $_POST['name']; ?>";
                            </script>
                        </select>
                    </div>
                </div>
            </div>


            <div class="container column is-10">

                <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Email</th>

                            <th>Time Taken</th>
                            <th>Date</th>
                            <th>Score</th>

                        </tr>
                    </thead>
<?php $i = 1;
foreach ($row as $rows) :
    ?>
                        <tbody>
                            <tr>
                                <th><?php echo $i; ?></th>
                                <td><?php echo $rows['user']; ?>
                                </td>

                                <td><?php echo $rows['time_taken']; ?></td>
                                <td><?php echo $rows['date']; ?></td>
                                <td><?php echo $rows['score']; ?></td>

                            </tr>



                        </tbody>
    <?php
    $i++;
endforeach;
?>
                </table>





            </div>
        </form>

    </div>




</section>
<!-- End main section-->

<?php
include_once '../User/footer.php';
?>
