<?php 

require_once('config/init.php');

use edelivery\template\Template;

$template = new Template('views/404.php');

echo $template;