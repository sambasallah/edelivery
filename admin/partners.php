<?php 

require_once('../config/init_.php');

use edelivery\models\Admin_Model;
use edelivery\models\Database_Model;
use edelivery\template\Template;
use edelivery\helpers\Functions;

$database = new Database_Model();

$admin = new Admin_Model($database);

$helper_functions = new Functions();

$template = new Template('views/partners.php');

if($helper_functions->isAdminLoggedIn()) {
    $page_no = 1; // default page

if(isset($_GET['page']) && is_numeric($_GET['page'])) {
    $template->page = $_GET['page'];
    $template->partners = $admin->getAllPartners($_GET['page']);
} else {
    $template->partners = $admin->getAllPartners($page_no);
}

if($helper_functions->isPost() && isset($_POST['delete_partner'])) {
    $admin->deletePartner($_POST['partner_id']);
}

$template->total_pages = $admin->getTotalPages();

echo $template;
} else {
    header("location:login");
}