<?php 

require_once('config/init.php');

use edelivery\template\Template;
use edelivery\helpers\Functions;
use edelivery\models\Partner_Model;
use edelivery\models\Database_Model;

$template = new Template('views/register-partner.php');

$database = new Database_Model();

$partner = new Partner_Model($database);

$helper_functions = new Functions();

if($helper_functions->isPost()) {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email_address = $_POST['email_address'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $municipality = $_POST['municipality'];
    $username = $_POST['username'];
    $vehicle_type = $_POST['vehicle_type'];
    $password = \password_hash($_POST['password'], PASSWORD_ARGON2ID,['cost' => 10, 'memory_cost' => 2048, 'threads' => 4]);

    $data = array(
        "first_name" => $first_name,
        "last_name" => $last_name,
        "email_address" => $email_address,
        "phone_number" => $phone_number,
        "address" => $address,
        "municipality" => $municipality,
        "username" => $username,
        "password" => $password,
        "vehicle_type" => $vehicle_type
    );

    $partner->registerPartner($data,$_FILES,$_FILES);
 }
 
echo $template;