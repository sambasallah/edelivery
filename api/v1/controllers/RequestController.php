<?php

namespace edelivery\api\v1\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use edelivery\api\v1\database\Database;
use edelivery\api\v1\models\Merchant_Model;

class RequestController {



    public function __invoke(Request $request, Response $response, $args) {
        $contentType = $request->getHeaderLine('Content-Type');
        if (strstr($contentType, 'application/json')) {
            $post_data = json_decode(file_get_contents('php://input'), true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $database = new Database();
                $merchant = new Merchant_Model($database);

                $rate_id = $merchant->getDeliveryRateID($post_data['to']['to_location'],$post_data['from']['from_location']);

                $data = array(
                    "to_location" => $post_data['to']['to_location'],
                    "from_location" => $post_data['from']['from_location'],
                    "receipient_name" => $post_data['receipient_information']['receipient_name'],
                    "receipient_mobile_number" => $post_data['receipient_information']['receipient_mobile_number'],
                    "receipient_address" => $post_data['receipient_information']['receipient_address'],
                    "sender_name" => $post_data['sender_information']['sender_name'],
                    "sender_mobile_number" => $post_data['sender_information']['sender_mobile_number'],
                    "sender_address" => $post_data['sender_information']['sender_address'],
                    "pick_up_date" => $post_data['data']['pick_up_date'],
                    "package_type" => $post_data['data']['package_type'],
                    "package_size" => $post_data['data']['package_size'],
                    "merchant_username" => $post_data['merchant_username'],
                    "delivery_note" => $post_data['data']['delivery_note'],
                    "item_name" => $post_data['data']['item_name'],
                    "rate_id" => $rate_id
                );

                $success = $merchant->makeDeliveryRequest($data);
                
                if($success) {
                    $response->getBody()->write(json_encode(array("Success" => $success, "Status Code" => \http_response_code(),"data" => "Delivery Request Sent")));
                    return $response->withHeader("Content-Type", "application/json"); 
                }
            }
        }

    }

}