<?php 

require_once('../config/init_.php');

use edelivery\template\Template;
use edelivery\models\Database_Model;
use edelivery\models\Merchant_Model;
use edelivery\helpers\Functions;

$helper_functions = new Functions();

if($helper_functions->isMerchantLoggedIn()) {

    $template = new Template('views/dashboard.php');
    $database = new Database_Model();
    $merchant = new Merchant_Model($database);
    
    $merchant_id = $merchant->getMerchantID($_SESSION['user']);

    $template->profile_complete = $helper_functions->profileCompleteStatus();

    $helper_functions->unsetProfileCompleteStatus();

    $template->account_balance_status = $helper_functions->accountBalanceStatus();

    $helper_functions->unsetAccountBalanceStatus();

    $template->total_spent = $merchant->calculateTotalSpentOnDeliveries($merchant_id);
    
    $template->ongoingDelvs = $merchant->getOngoingDeliveries();

    $template->account_balance = $merchant->getAccountBalance($merchant_id); 

    echo $template;
}else {
    \header("location:../register");
}