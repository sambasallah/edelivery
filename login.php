<?php 

require_once('config/init.php');

use edelivery\template\Template;
use edelivery\models\Database_Model;
use edelivery\models\Merchant_Model;

$database = new Database_Model();

$merchant = new Merchant_Model($database);

$template = new Template('views/login.php');


if($_SERVER['REQUEST_METHOD'] == "POST") {
    $usernameOREmail = $_POST['username_or_email'];
    $password = $_POST['password'];

    $data = array(
        "usernameOREmail" => $usernameOREmail,
        "password" => $password
    );

    $merchant->loginMerchant($data);

} 

echo $template;