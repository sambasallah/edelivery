<?php 

require_once('../config/init_.php');

use edelivery\template\Template;
use edelivery\models\Database_Model;
use edelivery\models\Merchant_Model;

if($_SESSION['merchant_logged_in'] === TRUE) {

    $database = new Database_Model();

    $merchant = new Merchant_Model($database);

    $template = new Template('views/profile.php');

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $first_name = stripslashes($_POST['first_name']);
        $middle_name = stripslashes($_POST['middle_name']);
        $last_name = stripslashes($_POST['last_name']);
        $email = stripslashes($_POST['email']);
        $username = stripslashes($_POST['username']);
        $password = password_hash(stripslashes($_POST['password']),PASSWORD_ARGON2ID);
        $dob = stripslashes($_POST['dob']);
        $address = stripslashes($_POST['address']);
        $business_name = stripslashes($_POST['business_name']);
        $business_location = stripslashes($_POST['business_location']);
        $business_email = stripslashes($_POST['business_email']);
        $business_phone = stripslashes($_POST['business_phone']);

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