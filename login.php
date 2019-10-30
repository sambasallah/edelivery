<?php 

require_once('config/init.php');

use edelivery\template\Template;

$template = new Template('views/login.php');

echo $template;