<?php 

require_once('config/init.php');

use edelivery\template\Template;
use edelivery\models\Database_Model;
use edelivery\models\Auth_Model;
use edelivery\helpers\Functions;

$database = new Database_Model();

$template = new Template('views/login.php');

$helper_functions = new Functions();

$auth = new Auth_Model($database);


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
    
        $auth->loginUser($data,'merchant');
    
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
    
        $partner->loginPartner($data,'partner');
    
} 


echo $template;