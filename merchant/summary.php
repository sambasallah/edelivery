<?php 

require_once('../config/init_.php');

use edelivery\template\Template;
use edelivery\models\Database_Model;
use edelivery\models\Merchant_Model;

if($_SESSION['merchant_logged_in'] === TRUE) {

    $database = new Database_Model();

    $merchant = new Merchant_Model($database);

    $template = new Template('views/summary.php');

    $merchant_id = $merchant->getMerchantID($_SESSION['user']);

    $template->delivery_summary = $merchant->getAllDeliveryRequests($merchant_id);

    if(isset($_POST['cancel_request'])) {
        $merchant->cancelDeliveryRequest($_POST['request_id'],$merchant_id);
    }

    echo $template;
}else {
    header("location:../register");
}