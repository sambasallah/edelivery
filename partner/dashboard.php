<?php 

require_once('../config/init_.php');

use edelivery\template\Template;
use edelivery\helpers\Functions;
use edelivery\models\Database_Model;
use edelivery\models\Partner_Model;

$helpers = new Functions(); 

if($helpers->isPartnerLoggedIn()) {
    $database = new Database_Model();
    $partner = new Partner_Model($database);

    $template = new Template('views/dashboard.php');

    $partner_id = $partner->getPartnerID($_SESSION['user']);

    // $template->earnings = $partner->getTotalEarnings($partner_id);
    $template->withdrawals = $partner->getTotalWithdrawals($partner_id);
    $template->balance = $partner->getBalance($partner_id);

    unset($_SESSION['upload_error']);
    unset($_SESSION['profile_success']);

   
    echo $template;
} else {
    \header("location:../login");
}