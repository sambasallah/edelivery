<?php

require_once('../config/init_.php');

use edelivery\models\Database_Model;
use edelivery\models\Merchant_Model;
use edelivery\helpers\Functions;

$helper_functions = new Functions();

if($helper_functions->isSetMerchantLoggedIn()) {
    if($helper_functions->isMerchantLoggedIn()) {  
    
        $database = new Database_Model();
        $merchant = new Merchant_Model($database);

        $merchant_id = $merchant->getMerchantID($_SESSION['user']);

        $totalRequests = $merchant->getTotalWeeklyDeliveryRequests($merchant_id);
    
        $arr_data['data'] = array();
    
        foreach($totalRequests as $deliveryRequest) {
    
            $day = "";
            switch($deliveryRequest->day) {
              case 1:
                    $day = "Sunday";
                    break;
              case 2: 
                    $day = "Monday";
                    break;
              case 3: 
                    $day = "Tuesday";
                    break;
              case 4: 
                    $day = "Wednesday";
                    break;
              case 5: 
                    $day = "Thursday";
                    break;
              case 6: 
                    $day = "Friday";
                    break;
              case 7: 
                    $day = "Saturday";
                    break;
              default:
                    $day = "Unrecognised date";
                    break;
            }
            
                $daily_data = array (
                    "Day" => $day,
                    "Request" => $deliveryRequest->total_daily_requests
                );
                array_push($arr_data['data'],$daily_data);
        }
    }
        
        echo json_encode($arr_data,JSON_PRETTY_PRINT);
} else {
    echo json_encode(array(
        "Unauthorized Access" => "Please Login"
    ),JSON_PRETTY_PRINT);
}