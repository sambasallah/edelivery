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

    $template = new Template('views/withdrawal-request.php');

    if($helper_functions->isPost() && isset($_POST['withdraw'])) {
        $name = $_POST['name'];
        $amount = $_POST['amount'];
        $bank_name = $_POST['bank_name'];
        $account_number = $_POST['account_number'];
        $bban_number = $_POST['bban_number'];

        $data = array(
            "name" => $name,
            "amount" => $amount,
            "bank_name" => $bank_name,
            "account_number" => $account_number,
            "bban_number" => $bban_number
        );

        $partner->requestWithdrawal($data,$partner_id);
    }

    if(isset($_GET['edit']) && $partner->idExists($_GET['edit'])) {
        
        $template->withdrawal_request = $partner->getWithdrawalRequest($_GET['edit']);

        echo $template;
    }

    if($helper_functions->isPost() && isset($_POST['update'])) {
        $data = array(
            "name" => $_POST['name'],
            "bank_name" => $_POST['bank_name'],
            "amount" => $_POST['amount'],
            "bban_number" => $_POST['bban_number'],
            "account_number" => $_POST['account_number']
        );

        $partner->updateWithdrawalRequest($data,$_POST['id']);
    }

    echo $template;

    
} else {
    \header("location:../login");
}