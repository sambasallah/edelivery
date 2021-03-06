
<?php

require_once('../config/init_.php');

use edelivery\models\Database_Model;
use edelivery\models\Admin_Model;
use edelivery\helpers\Functions;

$helper_functions = new Functions();

if($helper_functions->isAdminLoggedIn()) {
    
        $database = new Database_Model();
        $admin = new Admin_Model($database);

        $total_revenue = $admin->getTotalWeeklyRevenue();
    
        $arr_data['data'] = array();
    
        foreach($total_revenue as $revenue) {
    
            $day = "";
            switch($revenue->day) {
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
                    "Revenue" => $revenue->total_revenue
                );
                array_push($arr_data['data'],$daily_data);
        }
    
        
        echo json_encode($arr_data,JSON_PRETTY_PRINT);
} else {
    echo json_encode(array(
        "Unauthorized Access" => "Please Login"
    ),JSON_PRETTY_PRINT);
}