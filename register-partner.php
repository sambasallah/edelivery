<?php 

require_once('config/init.php');

use edelivery\template\Template;

$template = new Template('views/register-partner.php');

if($_SERVER['REQUEST_METHOD'] === "POST") {
    header("location:home");
 }
 

echo $template;