<?php 

require_once('config/init.php');

use edelivery\template\Template;
use edelivery\models\Database_Model;
use edelivery\models\Merchant_Model;
use edelivery\helpers\Functions;
use edelivery\helpers\Error_Messages;

$template = new Template('views/register.php');

$database = new Database_Model();

$merchant = new Merchant_Model($database);

$helper_functions = new Functions();

$error_messages = new Error_Messages();

// Register merchant
if($helper_functions->isPost()) {
    
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_name = $_POST['middle_name'];
    $email = $_POST['email'];
    $password = \password_hash($_POST['password'], PASSWORD_ARGON2ID,['cost' => 10, 'memory_cost' => 2048, 'threads' => 4]);
    $username = $_POST['username'];

    $data = array(
        "first_name" => $first_name,
        "last_name" => $last_name,
        "middle_name" => $middle_name,
        "email" => $email,
        "password" => $password,
        "username" => $username
    );

    $merchant->registerMerchant($data);
}

// Error Messages
$template->email_exists = $error_messages->emailExists();
$template->username_exists = $error_messages->usernameExists();
$template->error_merchant = $error_messages->errorMerchant();

echo $template;

