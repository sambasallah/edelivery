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

    unset($_SESSION['delete_success']);
    unset($_SESSION['delete_error']);

    $partner_id = $partner->getPartnerID($_SESSION['user']);

    $template->earnings = $partner->getTotalEarnings($partner_id);
    $template->withdrawals = $partner->getTotalWithdrawals($partner_id);
    $template->balance = $partner->getBalance($partner_id);

   
    echo $template;
} else {
    \header("location:../login");
}