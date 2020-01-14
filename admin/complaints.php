<?php 

require_once('../config/init_.php');

use edelivery\models\Admin_Model;
use edelivery\models\Database_Model;
use edelivery\template\Template;
use edelivery\helpers\Functions;

$database = new Database_Model();

$admin = new Admin_Model($database);

$helper_functions = new Functions();

$template = new Template('views/complaints.php');

if($helper_functions->isAdminLoggedIn()) {
    
   $template->complaints = $admin->getAllComplaints();

    echo $template;
} else {
    header("location:login");
}

