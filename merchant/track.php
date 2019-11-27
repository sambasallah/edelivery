
<?php 

require_once('../config/init_.php');

use edelivery\template\Template;
use edelivery\models\Database_Model;
use edelivery\models\Merchant_Model;

if($_SESSION['merchant_logged_in'] === TRUE) {

    $template = new Template('views/track.php');
    $database = new Database_Model();
    $merchant = new Merchant_Model($database);
    
 

    echo $template;
}else {
    header("location:../register");
}