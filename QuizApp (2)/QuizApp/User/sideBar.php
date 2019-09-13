<!DOCTYPE html>

<?php
$query = 'select DISTINCT test_name from test1_table';

$statement = $conn->prepare($query);
$statement->execute();
$tests = $statement->fetchAll();

?>
 <section class="main-content columns is-fullheight" style="margin-top: 1%;">
        <aside class="column is-2 is-narrow-mobile is-fullheight section is-hidden-mobile">
            <p class="menu-label is-hidden-touch">Navigation</p>
            <ul class="menu-list">
                <li>
                    <a href="question.php">
                        <span class="icon"><i class="fa fa-home"></i></span> Home
                    </a>
                </li>
                <li>
                    <a >
                        <span class="icon"><i class="fa fa-table"></i></span> Tests
                    </a>

                    <ul>
                        <?php  foreach ($tests as $test) : ?>
                        <li>
                            
                            <a href="test1.php?testno=<?php echo $test['test_name']."";?>"   >
                                <span class="icon is-small"><i class="fa fa-link" ></i></span><?php $_SESSION['test_session']=$test['test_name'];echo $test['test_name']; ?> 
                            </a>
                        </li>
                          <?php endforeach; ?>
                    </ul>
                </li>
                <li>
                    <a href="score.php" class="">
                        <span class="icon"><i class="fa fa-info"></i></span> Scores
                    </a>
                </li>
                <li>
                    <a href="register.php">
                        <span class="icon"><i class="fa fa-user"></i></span> Update Profile
                    </a>
                </li>
                <li>
                    <a href="../User/logOut.php" class="">
                        <span class="icon"><i class="fas fa-sign-out-alt"></i></span> LogOut
                    </a>
                </li>
            </ul>
        </aside>




        <!--End Sidebar -->

