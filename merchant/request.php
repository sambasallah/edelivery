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

    $template = new Template('views/request.php');

    $merchant_id = $merchant->getMerchantID($_SESSION['user']);

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $to = $_POST['to'];
        $from = $_POST['from'];
        $receipient_name = $_POST['receipient_name'];
        $receipient_mobile_number = $_POST['receipient_mobile_number'];
        $receipient_address = $_POST['receipient_address'];
        $sender_name = $_POST['sender_name'];
        $sender_mobile_number = $_POST['sender_mobile_number'];
        $sender_address = $_POST['sender_address'];
        $package_type = $_POST['package_type'];
        $pick_up_date = $_POST['pick_up_date'];
        $package_size = $_POST['package_size'];
        $delivery_note = $_POST['delivery_note'];
        $payment_method = $_POST['payment_method'];
        $item_name = $_POST['item_name'];

        // Get the delivey rate_id
        $rate_id = $merchant->getDeliveryRateID($to,$from);

        $data = array(
            "to" => $to,
            "from" => $from,
            "receipient_name" => $receipient_name,
            "receipient_mobile_number" => $receipient_mobile_number,
            "receipient_address" => $receipient_address,
            "sender_name" => $sender_name,
            "sender_mobile_number" => $sender_mobile_number,
            "sender_address" => $sender_address,
            "package_type" => $package_type,
            "pick_up_date" => $pick_up_date,
            "package_size" => $package_size,
            "rate_id" => $rate_id,
            "delivery_note" => $delivery_note,
            "payment_method" => $payment_method,
            "item_name" => $item_name
        );

        $merchant_id = $merchant->getMerchantID($_SESSION['user']);
        $delivery_rate = $merchant->calculateDeliveryRate($to,$from);
        if($merchant->isAccountBalanceSufficient($merchant_id,$delivery_rate)) {
            $merchant->makeDeliveryRequest($data,$merchant_id);
        }else {
            $_SESSION['insufficient_balance'] = 
            "<div class='alert alert-danger alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Failed!</strong> Insufficient Account Balance.
          </div>";
          header("location:dashboard");
        }
        }
        echo $template;
}else {
    header("location:../register");
}