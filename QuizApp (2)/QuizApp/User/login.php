<?php
include_once './Header.php';

//Login page start
if (isset($_SESSION['User_email']) && ($_SESSION['User_name'])) {
    if($_SESSION['User_email']=='admin@gmail.com'){
        echo "<script>  window.location.href='../Admin/admin.php';</script>";
    }
    
    else{
        echo "<script>  window.location.href='question.php';</script>";
    }
}
//https://www.webslesson.info/2016/06/php-login-script-using-pdo-with-session.html
if (isset($_POST['login'])) {
    $user_email = $_POST['User_email'];
    $user_psw = $_POST['User_psw'];
    $user_name;
    if (empty($user_email) && empty($user_psw)) {
        $message = 'Fields empty';
    } else {
        $query = "SELECT * FROM user WHERE User_email = '$user_email' AND User_psw = '$user_psw'";
        $statement = $conn->prepare($query);
        $statement->execute(
                array(
                    'User_email' => $user_email,
                    'User_psw' => $user_psw,
                )
        );
        $allValues = $statement->fetch();
        $count = $statement->rowCount();
        // print_r($allValues);
        if ($count > 0) {
            $_SESSION["User_email"] = $allValues["User_email"];
            $_SESSION['User_name'] = $allValues['User_name'];
            $_SESSION['User_lstname'] = $allValues['User_lstname'];
       

            // print_r($_SESSION['User_name']);
            // echo'logged in';
            if ($allValues["User_email"] == 'admin@gmail.com') {
                echo "<script type='text/javascript'>
			 alert('ADMIN LOGGED IN SUCCESSFULLY');
                        window.location.href='../Admin/admin.php';
			 </script>";
            } else {
                echo "<script type='text/javascript'>
			 alert('YOU ARE LOGGED IN SUCCESSFULLY');
                         window.location.href='question.php';
			 </script>";
            }
            //header("location:question.php");
        } else {
            echo "<script type='text/javascript'>
			 alert('You are not logged in...');
                        
			 </script>";
        }
    }
}
//login page ends
//registration page starts
//http://thisinterestsme.com/php-user-registration-form/
if (isset($_POST['register'])) {
    $first_name = !empty($_POST['first_name']) ? trim($_POST['first_name']) : null;
    $lst_name = !empty($_POST['lst_name']) ? trim($_POST['lst_name']) : null;
    $email = !empty($_POST['email_reg']) ? trim($_POST['email_reg']) : null;
    $number = !empty($_POST['number']) ? trim($_POST['number']) : null;
    $pass = !empty($_POST['psw_reg']) ? trim($_POST['psw_reg']) : null;
    $address = !empty($_POST['address']) ? trim($_POST['address']) : null;

    //Now, we need to check if the supplied username already exists.
    //Construct the SQL statement and prepare it.
    $sql = "SELECT COUNT(User_email) AS num FROM user WHERE User_email = :username";
    $stmt = $conn->prepare($sql);

    //Bind the provided username to our prepared statement.
    $stmt->bindValue(':username', $email);

    //Execute.
    $stmt->execute();

    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($row['num'] > 0) {

        echo "<script type='text/javascript'>
			 alert('USER ALREADY EXIST!!');
                        window.location.href='login.php';
			 </script>";
    }
    //  $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));
    //Prepare our INSERT statement.
    //Remember: We are inserting a new row into our users table.
    $sql1 = "INSERT INTO user ( User_name, User_lstname, User_email, User_number, User_psw, User_address,User_Status) VALUES (:username,:userlastname,:useremail,:usernumber, :password, :address, :Status)";
    $stmt = $conn->prepare($sql1);

    //Bind our variables.
    $stmt->bindValue(':username', $first_name);
    $stmt->bindValue(':userlastname', $lst_name);
    $stmt->bindValue(':useremail', $email);
    $stmt->bindValue(':usernumber', $number);
    $stmt->bindValue(':password', $pass);
    $stmt->bindValue(':address', $address);
    $stmt->bindValue(':Status', 0);



    //Execute the statement and insert the new account.
    $result = $stmt->execute();

    //If the signup process is successful.
    if ($result) {
        //What you do here is up to you!
        echo "<script type='text/javascript'>
			 alert('YOU ARE REGISTERED SUCCESSFULLY...');
                        
			 </script>";
    }
}

//registrations page ends
?>
<!DOCTYPE html>

<head>
     <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Quiz mania</title>
        <link rel="shortcut icon" href="../images/logo1.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
        <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link rel="stylesheet" href="StyleSheets/login.css">
    <link rel="stylesheet" href="StyleSheets/navbar.css">
</head>
<body>

    <section class="section">
        <div class="container">
            <div class="columns is-mobile is-centered">
                <div class="column is-half is-narrow">
                    <p class="bd-notification is-primary">
                    <section>
                        <figure class="image">
                            <img src="../images/logo1.png" >
                        </figure>
                    </section><br>
                    <form  method="POST" action="login.php">
                        <div class="field">
                            <p class="control has-icons-left has-icons-right">
                                <input class="input" type="email" placeholder="Email" name="User_email">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <span class="icon is-small is-right">
                                    <i class="fas fa-check"></i>
                                </span>
                            </p>
                            <p class="help is-danger">
                                <?php
                                if (isset($message)) {
                                    echo '<label>' . $message . '</label>';
                                }
                                ?> 
                            </p>
                        </div>
                        <div class="field">
                            <p class="control has-icons-left">
                                <input class="input" type="password" placeholder="Password" name="User_psw">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </p>
                            <p class="help is-danger">
                                <?php
                                if (isset($message)) {
                                    echo '<label>' . $message . '</label>';
                                }
                                ?> 
                            </p>
                        </div>
                        <div class="field is-grouped is-grouped-centered">
                            <p class="control">

                                <input type="submit" name="login" class="button is-success" value="Login">

                            </p>


                        </div>
                        <div class="field is-grouped is-grouped-centered">

                            <p id='signuplink'>
                                <a class=" modal-button" data-target="modal-bis" >Don't Have Account? SignUp Here</a>
                            </p>

                        </div>
                    </form>

                </div>


            </div>
        </div>



    </section>
    <div id="modal-bis" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">

            <section class="modal-card-body" >

                <figure id="image1">
                    <img src="../images/logo1.png" >
                </figure>


                <div id="mainsection">
                    <h3>
                        SignUp
                    </h3>
                    <form action="" method="post">
                        <div class="columns is-multiline is-mobile">
                            <div class="column is-half">
                                <div class="field">

                                    <div class="control">

                                        <input class="input" type="text" placeholder="First Name" pattern="[A-Za-z]{1,32}"  title="Please Enter Alphabets" name="first_name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-half">
                                <div class="field">

                                    <div class="control">

                                        <input class="input" type="text" placeholder="Last Name" name="lst_name" pattern="[A-Za-z]{1,32}"  title="Please Enter Alphabets" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                     
                        <div class="field" id="email_field">

                            <div class="control has-icons-left has-icons-right">
                                <input class="input" type="email" placeholder="Email " name="email_reg" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                </span>

                            </div>

                        </div>
                      
                        <div class="columns is-multiline is-mobile">
                            <div class="column is-half">
                                <div class="field">

                                    <div class="control has-icons-left has-icons-right">
                                        <input class="input " type="tel" placeholder="Contact Number" name="number"  pattern="[0-9]{10}"  title="Please Enter 10 Digits" required>
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
                                               Minimum eight in length" required>
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-key"></i>
                                        </span>

                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="field">

                            <div class="control has-icons-left has-icons-right">
                                <input class="input" type="text" placeholder="Address" name="address">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-address-card"></i>
                                </span>

                            </div>

                        </div>
                        <div class="field is-grouped is-grouped-centered">
                            <p class="control">
                                <input type="submit" name="register" class="button is-success" value="Register">
                            </p>

                        </div>

                </div>

                </form>

            </section>

        </div>
        <button class="modal-close is-large" aria-label="close"></button>
    </div>
    <script>
        //https://siongui.github.io/2018/02/11/bulma-modal-with-javascript/
        'use strict';

        document.addEventListener('DOMContentLoaded', function() {

            // Modals

            var rootEl = document.documentElement;
            var $modals = getAll('.modal');
            var $modalButtons = getAll('.modal-button');
            var $modalCloses = getAll(' .modal-close');

            if ($modalButtons.length > 0) {
                $modalButtons.forEach(function($el) {
                    $el.addEventListener('click', function() {
                        var target = $el.dataset.target;
                        var $target = document.getElementById(target);
                        rootEl.classList.add('is-clipped');
                        $target.classList.add('is-active');
                    });
                });
            }

            if ($modalCloses.length > 0) {
                $modalCloses.forEach(function($el) {
                    $el.addEventListener('click', function() {
                        closeModals();
                    });
                });
            }


            function closeModals() {
                rootEl.classList.remove('is-clipped');
                $modals.forEach(function($el) {
                    $el.classList.remove('is-active');
                });
            }

            // Functions

            function getAll(selector) {
                return Array.prototype.slice.call(document.querySelectorAll(selector), 0);
            }

        });
    </script>
    <?php
    include_once './footer.php';
    ?>


