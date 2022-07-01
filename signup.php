<?php
include_once 'db.php';

session_start();
if(isset($_SESSION['username'])){
 header('Location:index.php?dashboard');
 exit;
}if(isset($_SESSION['client_id'])){
    header('Location:userIndex.php?userReservation.php');
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
                echo '<div class="alert alert-danger">Please Fill In All Fields</div>';
            }elseif (isset($_GET['loginE'])){
                echo '<div class="alert alert-danger">Username or Password Don\'t Match</div>';
            } elseif (isset($_GET['client'])){
                echo '<div class="alert alert-success">Client</div>';
            }  elseif (isset($_GET['admin'])){
                echo '<div class="alert alert-success">Admin</div>';
            } 
            ?>
        </div>
        <form class="form-signup" data-toggle="validator" action="ajaxUser.php" method="post">
            <div class="row">

                <div class="form-group col-lg-12">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="" required>
                </div>
                    
                <div class="form-group col-lg-12">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" placeholder="" required>
                </div>

                <div class="form-group col-lg-12">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="" required>
                </div>
                    

                <div class="form-group col-lg-12">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="" required>
                    
                </div>
            </div>

            <p>Already have an account? <a href="login.php">login</a></p>

            <button class="btn btn-lg btn-success btn-block btn-signin" type="submit" name="signup">SIGNUP</button>

        </form><!-- /form -->
    </div><!-- /card-container -->
</div><!-- /container -->

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/validator.min.js"></script>
</body>
</html>