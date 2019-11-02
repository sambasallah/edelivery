<?php

if(isset($_GET['signout'])) {
    session_start();
    unset($_SESSION['user_logged_id']);
    session_unset();
    session_destroy();
    header("location:../login");
} else {
    header("location:dashboard");
}