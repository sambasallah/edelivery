<?php 

require_once('../config/init_.php');

use edelivery\template\Template;
use edelivery\models\Database_Model;
use edelivery\models\Merchant_Model;

if($_SESSION['merchant_logged_in'] === TRUE) {

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
        $item_name = $_POST['item_name'];
        $item_price = $_POST['item_price'];
        $item_type = $_POST['item_type'];

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
            "item_name" => $item_name,
            "item_price" => $item_price,
            "item_type" => $item_type,
            "rate_id" => $rate_id
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