<?php 

require_once('config/init.php');

use edelivery\template\Template;

$template = new Template('views/home.php');

unset($_SESSION['under_review']);

echo $template;