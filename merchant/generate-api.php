<?php 

require_once('../config/init_.php');

use eshipping\template\Template;

$template = new Template('views/generate-api.php');

echo $template;