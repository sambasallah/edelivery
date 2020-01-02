<?php 

require_once('../config/init_.php');

use edelivery\models\Admin_Model;
use edelivery\models\Database_Model;
use edelivery\template\Template;
use edelivery\helpers\Functions;

$database = new Database_Model();

$admin = new Admin_Model($database);

$helper_functions = new Functions();

$template = new Template('views/edit-deliveries.php');

if($helper_functions->isAdminLoggedIn()) {
    if(isset($_GET['edit']) && is_numeric($_GET['edit']) && $admin->deliveryExists($_GET['edit'])) {
        $template->delivery_request = $admin->getDeliveryRequest($_GET['edit']);
    } else {
        header("location:deliveries");
    }
    
    echo $template;
} else {
    header("location:login");
}