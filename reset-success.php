<?php 

require_once('config/init.php');

use edelivery\template\Template;

if(isset($_SESSION['redirect_success']) && $_SESSION['redirect_success'] == true) {
        
    $template = new Template('views/reset-success.php');

    unset($_SESSION['redirect_success']);

    echo $template;
} else {
    header('location:reset-password');
}