<?php 

require_once('../config/init_.php');

use edelivery\template\Template;
use edelivery\models\Database_Model;
use edelivery\models\Merchant_Model;
use edelivery\helpers\Functions;

if($_SESSION['merchant_logged_in'] === TRUE) {

    $database = new Database_Model();

    $merchant = new Merchant_Model($database);

    $template = new Template('views/complaint.php');

    $helper_function = new Functions();

    if(isset($_POST['send_complaint']) && $helper_function->isPost()) {
        $complaint_text = $_POST['complaint_text'];
        $merchant_id = $merchant->getMerchantID($_SESSION['user']);
        $merchant->sendComplaint($complaint_text,$_POST['partner_id'], $merchant_id);
    }

    if(isset($_POST['not_received']) && $helper_function->isPost()) {
        $merchant->openComplaint($_POST['request_id'], $_POST['partner_id']);
    }


    echo $template;
}else {
    header("location:../register");
}