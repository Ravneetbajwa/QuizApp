
<!-- navbar started-->
<div class="margin-top-4p">
    <nav class="navbar is-transparent is-fixed-top">
        <div class="navbar-brand">
            <a class="navbar-item" >
                <img src="../images/logo1.png" alt="QuizMania" width="112" height="28">
            </a>
           
        </div>

        <div id="navbarExampleTransparentExample" class="navbar-menu">


            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="field is-grouped">
                        
                        <span id="nameTag" class="tag is-light  is-medium"><?php echo $_SESSION['User_name'].' '.  $_SESSION['User_lstname'];?></span>
                        <p class="control">
                            <a class="button is-primary" href="../User/logOut.php">
                            
                                <span class="icon">
                                    <i class="fas fa-sign-out-alt"></i>
                                </span>
                                <span>LogOut</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </nav>

<!-- End navbar-->
