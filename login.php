<?php 

require_once('config/init.php');

use edelivery\template\Template;
use edelivery\models\Database_Model;
use edelivery\models\Auth_Model;
use edelivery\helpers\Functions;
use edelivery\models\Partner_Model;
use edelivery\helpers\Alerts;

$database = new Database_Model();

$template = new Template('views/login.php');

$helper_functions = new Functions();

$auth = new Auth_Model($database);

$partner = new Partner_Model($database);

$alert = new Alerts();


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

    if(isset($_SESSION['token']) && $_SESSION['token'] == $_POST['_token']) {
        $auth->loginUser($data,'merchant');
    } else {
        header('location:login');
    }

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
        
        $partner_id = $partner->getPartnerID($usernameOREmail);

        if($partner->isAccountApproved($partner_id)) {
            if(isset($_SESSION['token']) && $_SESSION['token'] == $_POST['_token']) {
                $auth->loginUser($data,'partner');
            } else {
               header('location:login');
           }
        } else {
            if($partner->emailExists($usernameOREmail) || $partner->usernameExists($usernameOREmail)) {
                $_SESSION['partner_not_approved'] = TRUE;
            } else {
                $_SESSION['invalid_credentials'] = TRUE;
            }
        }
    
} 


$token =  md5(uniqid(mt_rand(),true));

$_SESSION['token'] = $token;

$template->token = $token;

$template->invalid_credentials = $alert->invalidCredentialsError();
$template->not_approved = $alert->partnerNotApproved();



$template->password_changed = $alert->passwordChanged();

echo $template;