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

    if(isset($_POST['cancel_request'])) {
        $merchant->cancelDeliveryRequest($_POST['request_id'],$merchant_id);
    }

    $page_no = 1; // default page

    if(isset($_GET['page']) && is_numeric($_GET['page'])) {
        $template->page = $_GET['page'];
        $template->delivery_summary = $merchant->getAllDeliveryRequests($merchant_id,$_GET['page']);
    } else {
        $template->delivery_summary = $merchant->getAllDeliveryRequests($merchant_id,$page_no);
    }

    $template->total_pages = $merchant->getTotalPages();


    echo $template;
}else {
    header("location:../register");
}