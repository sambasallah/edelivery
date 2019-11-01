<?php 

require_once('config/init.php');

use edelivery\template\Template;
use edelivery\models\Database_Model;
use edelivery\models\Merchant_Model;

$template = new Template('views/register.php');

$database = new Database_Model();

$merchant = new Merchant_Model($database);

// Register merchant
if($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $first_name = \stripslashes($_POST['first_name']);
    $last_name = \stripslashes($_POST['last_name']);
    $middle_name = \stripslashes($_POST['middle_name']);
    $email = \stripslashes($_POST['email']);
    $password = \password_hash(\stripslashes($_POST['password']), PASSWORD_ARGON2ID,['cost' => 10, 'memory_cost' => 2048, 'threads' => 4]);
    $username = \stripslashes($_POST['username']);

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


echo $template;

