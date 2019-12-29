<?php 

require_once('../config/init_.php');

use edelivery\template\Template;
use edelivery\helpers\Functions;
use edelivery\models\Database_Model;
use edelivery\models\Partner_Model;

$helpers = new Functions(); 

if($helpers->isPartnerLoggedIn() && isset($_GET['request'])) {
    $database = new Database_Model();
    $template = new Template('views/view-request.php');
    $partner = new Partner_Model($database);

    if(isset($_GET['request'])) {
        $template->request_summary = $partner->getDeliveryRequest($_GET['request']);
    }

    echo $template;
} else {
    \header("location:../login");
}