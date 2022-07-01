<?php


session_start();
// unset($_SESSION['user_id']);
// unset($_SESSION['username']);
// session_abort();
session_destroy();
header('Location:login.php');