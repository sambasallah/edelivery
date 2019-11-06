<?php 

require_once('../config/init_.php');

use edelivery\template\Template;
use edelivery\models\Database_Model;
use edelivery\models\Merchant_Model;

if($_SESSION['merchant_logged_in'] === TRUE) {

    $template = new Template('views/dashboard.php');
    $database = new Database_Model();
    $merchant = new Merchant_Model($database);
    
    $merchant_id = $merchant->getMerchantID($_SESSION['user']);

    $template->total_spent = $merchant->totalSpent($merchant_id);

    $template->account_balance = $merchant->getAccountBalance($merchant_id);

    echo $template;
}else {
    header("location:../register");
}