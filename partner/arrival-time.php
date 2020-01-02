<?php 

require_once('../config/init_.php');

use edelivery\template\Template;
use edelivery\helpers\Functions;
use edelivery\models\Database_Model;
use edelivery\models\Partner_Model;

$helpers = new Functions(); 

if($helpers->isPartnerLoggedIn() && isset($_GET['edit'])) {
    $database = new Database_Model();
    $template = new Template('views/arrival-time.php');
    $partner = new Partner_Model($database);

    if(isset($_POST['update_time']) && $helpers->isPost()) {
        $template->arrival_time = $partner->updateArrivalTime($_POST['arrival_time'],$_GET['edit']);
    }

    echo $template;
} else {
    \header("location:../login");
}