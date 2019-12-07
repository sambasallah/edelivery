<?php 

require_once('config/init.php');

use edelivery\template\Template;
use edelivery\helpers\Functions;

$template = new Template('views/register-partner.php');

$helper_functions = new Functions();

if($helper_functions->isPost()) {
    header("location:home");
 }
 
echo $template;