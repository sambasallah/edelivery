<?php 

require_once('config/init.php');

use edelivery\template\Template;
use edelivery\models\Database_Model;
use edelivery\models\Merchant_Model;
use edelivery\helpers\Functions;
use edelivery\models\Partner_Model;

$database = new Database_Model();

$merchant = new Merchant_Model($database);

$template = new Template('views/login.php');

$helper_functions = new Functions();

$partner = new Partner_Model($database);


if($helper_functions->isMerchantLoggedIn()) {
    header("location:merchant");
}

if($helper_functions->isPost() && isset($_POST['login_merchant'])) {
        $usernameOREmail = $_POST['username_or_email'];
        $password = $_POST['password'];
    
        $data = array(
            "usernameOREmail" => $usernameOREmail,
            "password" => $password
        );
    
        $merchant->loginMerchant($data);
    
} 

if($helper_functions->isPartnerLoggedIn()) {
    header("location:partner");
}

if($helper_functions->isPost() && isset($_POST['login_partner'])) {
        $usernameOREmail = $_POST['username_or_email'];
        $password = $_POST['password'];
    
        $data = array(
            "usernameOREmail" => $usernameOREmail,
            "password" => $password
        );
    
        $partner->loginPartner($data);
    
} 


echo $template;