<?php

if(isset($_GET['signout'])) {
    session_start();
    session_unset();
    session_destroy();
    header("location:../login");
} else {
    header("location:dashboard");
}