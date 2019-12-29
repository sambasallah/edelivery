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

    $template = new Template('views/profile.php');

    $template->profile_information = $partner->getProfileInformation($partner_id);

    if($helper_functions->isPost()) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $username = $_POST['username'];
        $password = $partner->isPasswordChanged($_POST['password']) ? $_POST['password'] : "";
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];

        $data = array(
            "first_name" => $first_name,
            "last_name" => $last_name,
            "username" => $username,
            "password" => $password,
            "email" => $email,
            "phone_number" => $phone_number
        );

        $partner->updateProfileInformation($data,$partner_id);
    }

    echo $template;
} else {
    \header("location:../login");
}