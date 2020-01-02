<?php

if(isset($_GET['signout'])) {
    session_start();
    session_destroy();
    header("location:login");
} else {
    header("location:dashboard");
}