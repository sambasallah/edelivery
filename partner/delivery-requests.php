<?php 

require_once('../config/init_.php');

use edelivery\template\Template;
use edelivery\models\Database_Model;
use edelivery\helpers\Functions;
use edelivery\models\Partner_Model;

$helpers = new Functions(); 

if($helpers->isPartnerLoggedIn()) {
    $database = new Database_Model();

    $partner = new Partner_Model($database);

    $template = new Template('views/delivery-requests.php');

    $page_no = 1; // default page_no

    if(isset($_GET['page']) && is_numeric($_GET['page'])) {
        $template->page = $_GET['page'];
        $template->delivery_requests = $partner->getAllDeliveryRequests($_GET['page']);
    } else {
        $template->delivery_requests = $partner->getAllDeliveryRequests($page_no);
    }

    $template->total_pages = $partner->getTotalPages();

    $partner_id = $partner->getPartnerID($_SESSION['user']);
    $template->user = $partner_id;
    $template->accepted = $partner->acceptedARequest($partner_id);

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $partner->acceptDeliveryRequest($partner_id, $_POST['request_id']);
    }

    echo $template;

   
} else {
    \header("location:../login");
}