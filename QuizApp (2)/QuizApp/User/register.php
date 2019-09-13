<!DOCTYPE html>
<?php
include_once './Header.php';


if (!isset($_SESSION['User_email'])) {
    echo "<script type='text/javascript'>
      alert('Login First');

      </script>";
} else {

    $query = 'select * from user where User_email= ?';
    
    $statement = $conn->prepare($query);
    $statement->bindParam(1,$_SESSION['User_email']);
    $statement->execute();
   
    $users = $statement->fetchAll();
        
    
    if(isset($_POST['update']))
    {
        $user_email=$_SESSION['User_email'];
        $user_name=$_POST['first_name'];
        $user_lstname=$_POST['lst_name'];
        $user_psw=$_POST['psw_reg'];
        $user_address=$_POST['address'];
        $user_phn=$_POST['number'];
      
        $query = "UPDATE user SET User_name=?, User_lstname=?,User_number=?,User_psw=?,User_address=?  WHERE User_email=?";
        $stmt = $conn->prepare($query);

        if ($stmt->execute([$user_name, $user_lstname, $user_phn, $user_psw, $user_address, $user_email])) {
            echo "<script type='text/javascript'>
      alert('USER RECORD UPDATED SUCCESSFULLY');
      window.location.href='question.php';

      </script>";
        } else {
            echo "<script type='text/javascript'>
      alert('USER RECORD NOT UPDATED');

      </script>";
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
   <!-- https://codepen.io/andreich1980/pen/OmobJQ -->
    <link rel="stylesheet" href="StyleSheets/question.css">
    <link rel="stylesheet" href="StyleSheets/navbar.css">
</head>
<body>

    <?php
    include_once './navbar.php';
    include_once './sideBar.php';
    ?>

    <div class="container column is-6" >
        <div class="section">
                 <div id="mainsection">
                            <h3>
                                Update Profile
                            </h3>
                            <form action="" method="post">
                                <div class="columns is-multiline is-mobile">
                                    <div class="column is-half">
                                        <div class="field">

                                            <div class="control">

                                                <input class="input" type="text" placeholder="First Name" pattern="[A-Za-z]{1,32}"  title="Please Enter Alphabets" name="first_name" value="<?php
        echo $users[0]['User_name'];
    ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column is-half">
                                        <div class="field">

                                            <div class="control">

                                                <input class="input" type="text" placeholder="Last Name" name="lst_name" pattern="[A-Za-z]{1,32}"  title="Please Enter Alphabets" value="<?php 
        echo $users[0]['User_lstname'];
     ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="field" id="email_field">

                                    <div class="control has-icons-left has-icons-right">
                                        <input class="input" type="email" placeholder="Email " name="email_reg" value="<?php 
        echo $users[0]['User_email'];
        ?>" readonly>
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-envelope"></i>
                                        </span>

                                    </div>

                                </div>

                                <div class="columns is-multiline is-mobile">
                                    <div class="column is-half">
                                        <div class="field">

                                            <div class="control has-icons-left has-icons-right">
                                                <input class="input " type="tel" placeholder="Contact Number" name="number"  pattern="[0-9]{10}"  title="Please Enter 10 Digits" value="<?php 
        echo $users[0]['User_number'];
    ?>" required>
                                                <span class="icon is-small is-left">
                                                    <i class="fas fa-phone"></i>
                                                </span>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="column is-half">
                                        <div class="field">

                                            <div class="control has-icons-left has-icons-right">
                                                <input class="input" type="password" placeholder="Password" name="psw_reg" pattern="^(?=.*?[A-Z])(?=(.*[a-z]){1,})(?=(.*[\d]){1,})(?=(.*[\W]){1,})(?!.*\s).{8,}$"  title="At least one upper case , 
                                                       At least one lower case , 
                                                       At least one digit,  
                                                       At least one special character, 
                                                       Minimum eight in length" value="<?php 
        echo $users[0]['User_psw'];
     ?>" required>
                                                <span class="icon is-small is-left">
                                                    <i class="fas fa-key"></i>
                                                </span>

                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div class="field">

                                    <div class="control has-icons-left has-icons-right">
                                        <input class="input" type="text" placeholder="Address" name="address" value="<?php 
        echo $users[0]['User_address'];
     ?>">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-address-card"></i>
                                        </span>

                                    </div>

                                </div>
                                <div class="field is-grouped is-grouped-centered">
                                    <p class="control">
                                        <input type="submit" name="update" class="button is-success" value="Update">
                                    </p>

                                </div>

                        </div>

                        </form>

                   

               
              
            
            <!--End Modal-->
        </div>
    </div>
</section>

<?php }?>
<?php
include_once './footer.php';
?>
    
