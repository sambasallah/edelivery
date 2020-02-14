<?php

namespace edelivery\api\v1\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use edelivery\api\v1\models\Merchant_Model;
use edelivery\api\v1\database\Database;

class CancelDeliveryRequestController {


    public function __invoke(Request $request, Response $response, $args) {

        $post_data = json_decode(file_get_contents("php://input"), true);

        $database = new Database();

        $merchant = new Merchant_Model($database);

        $merchant_id = $merchant->getMerchantID($post_data['usernameOREmail']);

        $success = $merchant->cancelDeliveryRequest($args['id'], $merchant_id);

        if($success) {
            $response->getBody()->write(json_encode(array("Success" => $success, "data" => "Delivery Request Canceled", "Status Code" => \http_response_code(201))));
            return $response->withHeader("Content-Type","application/json");
        } 
    }
}