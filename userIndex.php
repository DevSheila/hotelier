<?php
include_once "db.php";
session_start();
if (isset($_SESSION['client_id'])){
    $user_id = $_SESSION['client_id'];
    $userQuery = "SELECT * FROM user WHERE id = '$user_id'";
    $result = mysqli_query($connection, $userQuery);
    $user = mysqli_fetch_assoc($result);
}else{
    header('Location:login.php');
}
include_once "header.php";
include_once "userSidebar.php";


if (isset($_GET['userHome'])){
    include_once "userHome.php";
}
elseif (isset($_GET['userReservation'])){
    include_once "userReservation.php";
}
else{
    include_once "userHome.php";
}

include_once "footer.php";