<?php 

require_once('config/init.php');

use edelivery\template\Template;

$template = new Template('views/customer-support.php');

echo $template;