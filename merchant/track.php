
<?php 

require_once('../config/init_.php');

use edelivery\template\Template;
use edelivery\models\Database_Model;
use edelivery\models\Merchant_Model;
use edelivery\helpers\Functions;
use edelivery\helpers\Alerts;

$helper_functions = new Functions();

if($helper_functions->isMerchantLoggedIn()) {

    $template = new Template('views/track.php');
    $database = new Database_Model();
    $merchant = new Merchant_Model($database);

    $helper_functions = new Functions();
    $helper_alerts = new Alerts();

    if(isset($_POST['track']) && $helper_functions->isPost()) {
        $template->delivery_id = $_POST['delivery_id'];
        $template->delivery_information = $merchant->getDeliveryRequest($_POST['delivery_id']);
        echo $template;
    }

    if(isset($_POST['received']) && $helper_functions->isPost()) {
        $success = $merchant->acknowledgeDelivery($_POST['request_id']);
        if($success) {
            $_SESSION['acknowledged'] =  TRUE;
        } 
        $_SESSION['error_acknowledged'] =   FALSE;
    }


    if(isset($_POST['not_received']) && $helper_functions->isPost()) {
        $merchant->openComplaint($_POST['request_id'], $_POST['partner_id']);
    }
   
}else {
    header("location:../register");
}