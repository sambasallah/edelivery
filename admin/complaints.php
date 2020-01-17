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
    
    $page_no = 1;
    $template->total_pages = $admin->getTotalPages();

    if(!isset($_GET['page'])) {
        $template->complaints = $admin->getAllComplaints($page_no);
    } else {
        $template->complaints = $admin->getAllComplaints($_GET['page']);
    }

    if(isset($_POST['delete_complaint']) && $helper_functions->isPost()) {
        $admin->deleteComplaint($_POST['complaint_id']);
    }

    echo $template;
} else {
    header("location:login");
}

