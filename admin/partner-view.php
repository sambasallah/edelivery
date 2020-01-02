<?php 

require_once('../config/init_.php');

use edelivery\models\Admin_Model;
use edelivery\models\Database_Model;
use edelivery\template\Template;
use edelivery\helpers\Functions;

$database = new Database_Model();

$admin = new Admin_Model($database);

$helper_functions = new Functions();

$template = new Template("views/partner-view.php");

if($helper_functions->isAdminLoggedIn()) {
    if(isset($_POST['approve']) && $helper_functions->isPost()) {
        $admin->approvePartner($_GET['view']);
    }
    
    if(isset($_POST['revoke']) && $helper_functions->isPost()) {
        $admin->revokePartner($_GET['view']);
    }
    
    if(isset($_GET['view']) && is_numeric($_GET['view'])) {
        $template->partner_info = $admin->getPartnerInfo($_GET['view']);
    
        echo $template;
    } else {
        header("location:partners");
    }
} else {
    header("location:login");
}

