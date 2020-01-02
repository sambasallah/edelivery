<?php 

require_once('../config/init_.php');

use edelivery\models\Admin_Model;
use edelivery\models\Database_Model;
use edelivery\template\Template;
use edelivery\helpers\Functions;

$database = new Database_Model();

$admin = new Admin_Model($database);

$helper_functions = new Functions();

$template = new Template('views/deliveries.php');

if($helper_functions->isAdminLoggedIn()) {
    
$page_no = 1; // default page

if(isset($_GET['page']) && is_numeric($_GET['page'])) {
    $template->page = $_GET['page'];
    $template->deliveries = $admin->getAllDeliveries($_GET['page']);
} else {
    $template->deliveries = $admin->getAllDeliveries($page_no);
}

$template->total_pages = $admin->getTotalPages();

if($helper_functions->isPost() && isset($_POST['update_delivery'])) {
    $data = array(
        "to_location" => $_POST['to_location'],
        "from_location" => $_POST['from_location'],
        "receipient_name" => $_POST['receipient_name'],
        "sender_name" => $_POST['sender_name'],
        "sender_number" => $_POST['sender_number'],
        "receipient_number" => $_POST['receipient_number'],
        "delivery_note" => $_POST['delivery_note'],
        "id" => $_POST['id']

    );
    $admin->updateDeliveryRequest($data);
}

echo $template;

} else {
    header("location:login");
}