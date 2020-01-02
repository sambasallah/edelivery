<?php 

require_once('../config/init_.php');

use edelivery\models\Admin_Model;
use edelivery\models\Database_Model;
use edelivery\template\Template;
use edelivery\helpers\Functions;

$database = new Database_Model();

$admin = new Admin_Model($database);

$template = new Template('views/users.php');

$helper_functions = new Functions();

if($helper_functions->isAdminLoggedIn()) {
    $page_no = 1; // default page

if(isset($_GET['page']) && is_numeric($_GET['page'])) {
    $template->page = $_GET['page'];
    $template->users = $admin->getAllUsers($_GET['page']);
} else {
    $template->users = $admin->getAllUsers($page_no);
}

if($helper_functions->isPost() && isset($_POST['add_user'])) {
    \header('location:add-user');
}

if($helper_functions->isPost() && isset($_POST['delete_user'])) {
    if($admin->deleteUser($_POST['user_id'])) {
        header("location:users");
    }
}

$template->total_pages = $admin->getTotalPages();

echo $template;
} else {
    header("location:login");
}