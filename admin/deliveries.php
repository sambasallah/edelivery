<?php 

require_once('../config/init_.php');

use edelivery\template\Template;

$template = new Template('views/deliveries.php');

echo $template;