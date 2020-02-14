<?php

namespace edelivery\api\v1\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use edelivery\api\v1\models\Merchant_Model;
use edelivery\api\v1\database\Database;

class TrackDeliveryController {


    public function __invoke(Request $request, Response $response, $args) {

        $database = new Database();
        $merchant = new Merchant_Model($database);
        $delivery_status = $merchant->track(intval($args['id']));
        $driver_information = $merchant->getDriversInformation(intval($args['id']));
        if(empty($driver_information->partner_id)) {
            $response->getBody()->write(json_encode(array("Success" => true, "Status Code" => \http_response_code(200),"Delivery Status" => $delivery_status), JSON_PRETTY_PRINT));
        } else {
            $info = array(
                "Name" => $driver_information->first_name . ' ' . $driver_information->last_name,
                "Mobile Number" => $driver_information->phone_number,
                "Driver Status" => $driver_information->account_status,
                "Estimated Arrival Time" => $driver_information->arrival_time,
                "Vehicle Type" => $driver_information->vehicle_type,
                "Partner Picture" => "localhost/eshipping/storage/public/uploads/profile/".$driver_information->profile_picture
            );
            $response->getBody()->write(json_encode(array("Success" => true, "Status Code" => \http_response_code(200),"Delivery Status" => $delivery_status, "Your Drivers Information" => $info), JSON_PRETTY_PRINT));
        }
       
        return $response->withHeader("Content-Type", "application/json"); 
    }
}