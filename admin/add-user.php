<?php 

require_once('../config/init_.php');

use edelivery\models\Admin_Model;
use edelivery\models\Database_Model;
use edelivery\template\Template;
use edelivery\helpers\Functions;

$database = new Database_Model();

$admin = new Admin_Model($database);

$helper_functions = new Functions();

$template = new Template('views/add-user.php');

if($helper_functions->isAdminLoggedIn()) {
    
if($helper_functions->isPost() && isset($_POST['add_user'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = \password_hash($_POST['password'], PASSWORD_ARGON2ID,['cost' => 10, 'memory_cost' => 2048, 'threads' => 4]);
    $username = $_POST['username'];

    $data = array(
        "first_name" => $first_name,
        "last_name" => $last_name,
        "email" => $email,
        "username" => $username,
        "password" => $password
    );

    $admin->addUser($data);
}

if($helper_functions->isPost() && isset($_POST['update_user'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $admin->isPasswordChanged($_POST['password']) ?? \password_hash($_POST['password'], PASSWORD_ARGON2ID,['cost' => 10, 'memory_cost' => 2048, 'threads' => 4]) ?? "";
    $username = $_POST['username'];

    $data = array(
        "first_name" => $first_name,
        "last_name" => $last_name,
        "email" => $email,
        "username" => $username,
        "password" => $password
    );

    $admin->updateUser($data,$_POST['user_id']);
}

if(isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $template->user = $admin->getUser($_GET['edit']);    
} 
echo $template;
} else {
   header("location:login");
}