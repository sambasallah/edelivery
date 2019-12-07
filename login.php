<?php 

require_once('config/init.php');

use edelivery\template\Template;
use edelivery\models\Database_Model;
use edelivery\models\Merchant_Model;
use edelivery\helpers\Functions;

$database = new Database_Model();

$merchant = new Merchant_Model($database);

$template = new Template('views/login.php');

$helper_functions = new Functions();


if($helper_functions->isMerchantLoggedIn()) {
    header("location:merchant");
}

if($helper_functions->isPost()) {
        $usernameOREmail = $_POST['username_or_email'];
        $password = $_POST['password'];
    
        $data = array(
            "usernameOREmail" => $usernameOREmail,
            "password" => $password
        );
    
        $merchant->loginMerchant($data);
    
} 


echo $template;