<?php 

require_once('../config/init_.php');

use edelivery\template\Template;
use edelivery\models\Database_Model;
use edelivery\models\Merchant_Model;

if($_SESSION['merchant_logged_in'] === TRUE) {

    $database = new Database_Model();

    $merchant = new Merchant_Model($database);

    $template = new Template('views/summary.php');

    $template->delivery_summary = $merchant->getAllDeliveryRequests();

    if(isset($_POST['cancel_request'])) {
        $merchant->cancelDeliveryRequest($_POST['request_id']);
    }

    echo $template;
}else {
    header("location:../register");
}