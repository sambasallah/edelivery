<?php 

require_once('config/init.php');

use edelivery\template\Template;

$template = new Template('views/drivers-privacy.php');

echo $template;