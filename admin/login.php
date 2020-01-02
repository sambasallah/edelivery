<?php 

require_once('../config/init_.php');

use edelivery\models\Admin_Model;
use edelivery\models\Database_Model;
use edelivery\template\Template;
use edelivery\helpers\Functions;

$database = new Database_Model();

$admin = new Admin_Model($database);

$helper_functions = new Functions();

$template = new Template('views/login.php');

if($helper_functions->isPost()) {
    $data = array(
        "usernameOREmail" => $_POST['username_email'],
        "password" => $_POST['password']
    );

    $admin->loginAdmin($data);
}

echo $template;