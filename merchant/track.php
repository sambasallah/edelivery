
<?php 

require_once('../config/init_.php');

use edelivery\template\Template;
use edelivery\models\Database_Model;
use edelivery\models\Merchant_Model;

if($_SESSION['merchant_logged_in'] === TRUE) {

    $template = new Template('views/track.php');
    $database = new Database_Model();
    $merchant = new Merchant_Model($database);

    if($_POST['track']) {
        $template->delivery_id = $_POST['delivery_id'];
        $template->delivery_information = $merchant->getDeliveryRequest($_POST['delivery_id']);
        echo $template;
    }else {
        echo $template;
    }

    
    
   
}else {
    header("location:../register");
}