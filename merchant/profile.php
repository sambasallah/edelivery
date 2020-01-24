<?php 

require_once('../config/init_.php');

use edelivery\template\Template;
use edelivery\models\Database_Model;
use edelivery\models\Merchant_Model;
use edelivery\helpers\Functions;

$helper_functions = new Functions();

if($helper_functions->isMerchantLoggedIn()) {

    $database = new Database_Model();

    $merchant = new Merchant_Model($database);

    $template = new Template('views/profile.php');

    $helper_functions = new Functions();

    $template->profile_success = $helper_functions->successProfile();

    $helper_functions->unsetSuccessProfile();

    $template->profile_error = $helper_functions->errorProfile();

    $helper_functions->unsetErrorProfile();

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $merchant->isPasswordChanged($_POST['password'])? \password_hash($_POST['password'],PASSWORD_ARGON2ID,['cost' => 10, 'memory_cost' => 2048, 'threads' => 4]) : "";
        $dob = $_POST['dob'];
        $address = $_POST['address'];
        $business_name = $_POST['business_name'];
        $business_location = $_POST['business_location'];
        $business_email = $_POST['business_email'];
        $business_phone = $_POST['business_phone'];

        $data = array(
            "first_name" => $first_name,
            "middle_name" => $middle_name,
            "last_name" => $last_name,
            "email" => $email,
            "username" => $username,
            "password" => $password,
            "dob" => $dob,
            "address" => $address,
            "business_location" => $business_location,
            "business_name" => $business_name,
            "business_email" => $business_email,
            "business_phone" => $business_phone
        );

        $merchant->updateProfileInformation($data, $_SESSION['user']);
    }

    $template->profile_information = $merchant->getProfileInformation($_SESSION['user']);

    echo $template;
}else {
    header("location:../register");
}