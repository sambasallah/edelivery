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

    $template->delivery_requests = $partner->getAllDeliveryRequests();

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