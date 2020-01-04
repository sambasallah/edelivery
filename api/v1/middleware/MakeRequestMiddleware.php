<?php

namespace edelivery\api\v1\middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use edelivery\api\v1\database\Database;
use edelivery\api\v1\models\Merchant_Model;
use ReallySimpleJWT\Token;

class MakeRequestMiddleware {

    public function __invoke(Request $request, RequestHandler $handler) : Response
    {   
        $response = $handler->handle($request);
        $existingContent = (string) $response->getBody();
        $response = new Response();

        if($request->hasHeader("Authorization")) {
            $token = $request->getHeaderLine("Authorization");

            $secret = 'ede!VerY25*&';

            $valid = Token::validate($token,$secret);

            $contentType = $request->getHeaderLine('Content-Type');

            if($valid) {
                if (strstr($contentType, 'application/json')) {
                    $post_data = json_decode(file_get_contents('php://input'), true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        $database = new Database();
                        $merchant = new Merchant_Model($database);

                        $rate_id = $merchant->getDeliveryRateID($post_data['to_location'],$post_data['from_location']);

                        $data = array(
                            "to_location" => $post_data['to_location'],
                            "from_location" => $post_data['from_location'],
                            "receipient_name" => $post_data['receipient_name'],
                            "receipient_mobile_number" => $post_data['receipient_mobile_number'],
                            "receipient_address" => $post_data['receipient_address'],
                            "sender_name" => $post_data['sender_name'],
                            "sender_mobile_number" => $post_data['sender_mobile_number'],
                            "sender_address" => $post_data['sender_address'],
                            "pick_up_date" => $post_data['pick_up_date'],
                            "package_type" => $post_data['package_type'],
                            "package_size" => $post_data['package_size'],
                            "merchant_username" => $post_data['merchant_username'],
                            "delivery_note" => $post_data['delivery_note'],
                            "rate_id" => $rate_id
                        );

                        $success = $merchant->makeDeliveryRequest($data);
                        
                        if($success) {
                            $response->getBody()->write(json_encode(array("Success" => "Delivery Request Sent", "Status Code" => \http_response_code(),"Request Successful" => $success)));
                            return $response->withHeader("Content-Type", "application/json"); 
                        }
                    }
                }
            }
        }

        $response->getBody()->write($existingContent);
        return $response->withHeader("Content-Type", "application/json");  
    }

   
}