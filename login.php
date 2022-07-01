<?php
include_once 'db.php';

session_start();
if(isset($_SESSION['username'])){
 header('Location:index.php?dashboard');
 exit;
}if(isset($_SESSION['client_id'])){
    header('Location:userReservation.php');
    exit;
}
?>

<html>
<head>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css"/>
</head>
<body>


<div class="container">
    <div class="card card-container">
        <img id="profile-img" class="profile-img-card" src="img/htl.png"/>
        
        <br>
        <div class="result">
            <?php
            if (isset($_GET['empty'])){
                echo '<div class="alert alert-danger">Enter Username or Password</div>';
            }elseif (isset($_GET['loginE'])){
                echo '<div class="alert alert-danger">Username or Password Don\'t Match</div>';
            } elseif (isset($_GET['client'])){
                echo '<div class="alert alert-success">Client</div>';
            }  elseif (isset($_GET['admin'])){
                echo '<div class="alert alert-success">Admin</div>';
            } 
            ?>
        </div>
        <form class="form-signin" data-toggle="validator" action="ajax.php" method="post">
            <div class="row">
                <div class="form-group col-lg-12">
                    <label>Username or Email</label>
                    <input type="text" name="email" class="form-control" placeholder="" required
                           data-error="Enter Username or Email">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group col-lg-12">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="" required
                           data-error="Enter Password">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <p>Don't have an account? <a href="signup.php">sign up</a></p>

            <button class="btn btn-lg btn-success btn-block btn-signin" type="submit" name="login">LOGIN</button>

        </form><!-- /form -->
    </div><!-- /card-container -->
</div><!-- /container -->

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/validator.min.js"></script>
</body>
</html>