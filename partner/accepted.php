<?php 

require_once('../config/init_.php');

use edelivery\template\Template;
use edelivery\helpers\Functions;
use edelivery\models\Database_Model;
use edelivery\models\Partner_Model;


$helper_functions = new Functions();

if($helper_functions->isPartnerLoggedIn()) {

    $template = new Template("views/accepted.php");
    $database = new Database_Model();
    $partner = new Partner_Model($database);

    $partner_id = $partner->getPartnerID($_SESSION['user']);
    
    $template->accepted_requests = $partner->getAcceptedRequests($partner_id);

    if($helper_functions->isPost()) {
        
        $earned = $_POST['earned'];
        $to_location = $_POST['to_location'];
        $from_location = $_POST['from_location'];
        $package_size = $_POST['package_size'];
        $package_type = $_POST['package_type'];
        $rate = $_POST['rate'];

        $data = array(
            "earned" => $earned,
            "to_location" => $to_location,
            "from_location" => $from_location,
            "package_size" => $package_size,
            "package_type" => $package_type,
            "rate" => $rate
        );

        $partner->earningsSummary($data,$partner_id);

        $partner->updateEarnings($partner_id, $_POST['earned']);

        $partner->delivered($partner_id);

    }

    echo $template;
} else {
    header("location:../register-partner");
}