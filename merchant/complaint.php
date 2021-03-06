<?php 

require_once('../config/init_.php');

use edelivery\template\Template;
use edelivery\models\Database_Model;
use edelivery\models\Merchant_Model;
use edelivery\helpers\Functions;

$helper_functions = new Functions();

if($helper_functions->isMerchantLoggedIn()) {

    $database = new Database_Model();

    $merchant = new Merchant_Model($database);

    $helper_functions = new Functions();

    $template = new Template('views/complaint.php');

    if(isset($_POST['send_complaint']) && $helper_functions->isPost()) {
        $complaint_text = $_POST['complaint_text'];
        $merchant_id = $merchant->getMerchantID($_SESSION['user']);
        $merchant->sendComplaint($complaint_text,$_POST['partner_id'], $merchant_id);
    }

    echo $template;
}else {
    header("location:../register");
}