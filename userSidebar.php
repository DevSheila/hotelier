
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="img/user.png" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name"><?php echo $user['name'];?></div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>CLIENT</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>
    <ul class="nav menu">

    <?php 
        if (isset($_GET['userHome'])){ ?>
            <li class="active">
                <a href="userIndex.php?userHome"><em class="fa fa-home">&nbsp;</em>
                    Home
                </a>
            </li>
        <?php } else{?>
            <li>
                <a href="userIndex.php?userHome"><em class="fa fa-home">&nbsp;</em>
                    Home
                </a>
            </li>
        <?php }


        if (isset($_GET['userReservation'])){ ?>
            <li class="active">
            <a href="userIndex.php?userReservation"><em class="fa fa-calendar">&nbsp;</em>
                    Reservation
                </a>
            </li>
        <?php } else{?>
            <li>
            <a href="userIndex.php?userReservation"><em class="fa fa-calendar">&nbsp;</em>
                    Reservation
                </a>
            </li>
        <?php }
        ?>

        
    </ul>
</div><!--/.sidebar-->