<?php 

require_once('config/init.php');

use eshipping\template\Template;

$template = new Template('views/ecommerce.php');

echo $template;