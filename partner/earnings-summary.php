<?php 

require_once('../config/init_.php');

use edelivery\template\Template;
use edelivery\helpers\Functions;
use edelivery\models\Partner_Model;
use edelivery\models\Database_Model;

$helper_functions = new Functions(); 

if($helper_functions->isPartnerLoggedIn()) {
    
    $database = new Database_Model();

    $partner = new Partner_Model($database); 

    $partner_id = $partner->getPartnerID($_SESSION['user']);

    $template = new Template('views/earnings-summary.php');

    $template->earnings = $partner->getEarningSummary($partner_id);
   

    echo $template;
} else {
    \header("location:../login");
}