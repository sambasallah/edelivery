<?php 

require_once('../config/init_.php');

use edelivery\template\Template;

if($_SESSION['merchant_logged_in'] === TRUE) {

    $template = new Template('views/generate-api.php');

    echo $template;
}else {
    header("location:../register");
}