<?php 

require_once('../config/init.php');

use edelivery\template\Template;

$template = new Template('../views/terms-of-service.php');

echo $template;