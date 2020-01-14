
<?php 

require_once('../config/init_.php');

use edelivery\template\Template;
use edelivery\models\Database_Model;
use edelivery\models\Merchant_Model;
use edelivery\helpers\Functions;

if($_SESSION['merchant_logged_in'] === TRUE) {

    $template = new Template('views/track.php');
    $database = new Database_Model();
    $merchant = new Merchant_Model($database);

    $helper_functions = new Functions();

    if(isset($_POST['track']) && $helper_functions->isPost()) {
        $template->delivery_id = $_POST['delivery_id'];
        $template->delivery_information = $merchant->getDeliveryRequest($_POST['delivery_id']);
        echo $template;
    }

    if(isset($_POST['acknowledge']) && $helper_functions->isPost()) {
        $success = $merchant->acknowledgeDelivery($_POST['request_id']);
        if($success) {
            
            $_SESSION['acknowledged'] = 
            "<div class='alert alert-success'>
                <strong>Delivery Completed</strong>
            </div>";
            \header("location:summary");
            exit;
        } 
        $_SESSION['error_acknowledged'] = 
        "<div class='alert alert-danger'>
            <strong>Error! Acknowledging delivery request</strong>
        </div>";
        \header('location:summary');
        exit;
    }

    if(isset($_POST['not_received']) && $helper_functions->isPost()) {
        $merchant->notReceived($_POST['request_id']);
    }
   
}else {
    header("location:../register");
}