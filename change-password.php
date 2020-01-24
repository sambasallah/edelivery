<?php 

require_once('config/init.php');

use edelivery\template\Template;
use edelivery\models\Database_Model;
use edelivery\models\Reset_Password_Model;

$database = new Database_Model();

$auth = new Reset_Password_Model($database);

$template = new Template('views/change-password.php');

$email = "";

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['reset'])) {
    $template->email = $auth->getEmail($_POST['token']);
    $_SESSION['change_password'] = true;
        
} 

if(isset($_SESSION['change_password']) && $_SESSION['change_password'] == true) {
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['change'])) {
        $data = array(
            "password1" => $_POST['password1'],
            "password2" => $_POST['password2']
        );
        $auth->changePassword($_POST['email'], $data);
    }

    echo $template;
} else {
    header('location:reset-password');
}


