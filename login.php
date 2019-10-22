<?php 

require_once('config/init.php');

use eshipping\template\Template;

$template = new Template('views/login.php');

echo $template;