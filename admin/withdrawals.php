<?php 

require_once('../config/init_.php');

use edelivery\models\Admin_Model;
use edelivery\models\Database_Model;
use edelivery\template\Template;
use edelivery\helpers\Functions;
use edelivery\models\Partner_Model;

$database = new Database_Model();

$admin = new Admin_Model($database);

$partner = new Partner_Model($database);

$template = new Template('views/withdrawals.php');

$helper_functions = new Functions();

if($helper_functions->isAdminLoggedIn()) {
    
    if($helper_functions->isPost() && isset($_POST['approve'])) {
        $total_withdrawals = intval($_POST['withdrawal_amount']) + $admin->getTotalWithdrawals($_POST['partner_id']);
        $data = array(
            "withdrawal_amount" => $_POST['withdrawal_amount'],
            "total_withdrawals" => $total_withdrawals
        );
        $admin->approveWithdrawal($data, $_POST['partner_id']);
    }

    $template->withdrawals = $admin->getAllWithdrawalRequest();
  
    echo $template;

} else {
    header("location:login");
}