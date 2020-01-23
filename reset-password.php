<?php 

require_once('config/init.php');

use edelivery\template\Template;
use edelivery\models\Database_Model;
use edelivery\models\Auth_Model;

$database = new Database_Model();

$auth = new Auth_Model($database);

$template = new Template('views/reset-password.php');

if($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $token = $auth->generateToken();

    $auth->sendPasswordResetNotification($token, $_POST['email']);
}



echo $template;