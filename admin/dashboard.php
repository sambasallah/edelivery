<?php 

require_once('../config/init_.php');

use edelivery\models\Admin_Model;
use edelivery\models\Database_Model;
use edelivery\template\Template;
use edelivery\helpers\Functions;

$database = new Database_Model();

$admin = new Admin_Model($database);

$helper_functions = new Functions();

$template = new Template('views/dashboard.php');

if($helper_functions->isAdminLoggedIn()) {
    
    $template->number_of_partners = $admin->getTotalPartnerRows();
    $template->number_of_merchants = $admin->getTotalMerchantRows();
    $template->total_revenue = $admin->getTotalRevenue();

    echo $template;
} else {
    header("location:login");
}

