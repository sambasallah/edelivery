<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use edelivery\api\v1\middleware\RouteErrorHandler;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;
use Psr\Http\Server\RequestHandlerInterface;
use edelivery\api\v1\database\Database;
use edelivery\api\v1\middleware\CancelDeliveryRequestMiddleware;
use edelivery\api\v1\middleware\InternalLoginMiddleware;
use edelivery\api\v1\models\Merchant_Model;
use edelivery\api\v1\middleware\LoginMiddleware;
use edelivery\api\v1\middleware\MakeRequestMiddleware;
use edelivery\api\v1\middleware\TrackMiddleWare;
use ReallySimpleJWT\Token;
use Psr\Http\Message\StreamInterface;

require '../../vendor/autoload.php';
require 'init/init.php';

$app = AppFactory::create();

$app->group('/api/v1', function (RouteCollectorProxy $group) {

    // Make Delivery Request
    $group->post('/request',function (Request $request,Response $response, $args) {
        $contentType = $request->getHeaderLine('Content-Type');
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
                    $response->getBody()->write(json_encode(array("Success" => $success, "Status Code" => \http_response_code(),"data" => "Delivery Request Sent")));
                    return $response->withHeader("Content-Type", "application/json"); 
                }
            }
        }

      
    })->add(new MakeRequestMiddleware());

    // Cancel Delivery Request
    $group->post('/cancel/{id}', function(Request $request, Response $response, $args) {

        $post_data = json_decode(file_get_contents("php://input"), true);

        $database = new Database();

        $merchant = new Merchant_Model($database);

        $merchant_id = $merchant->getMerchantID($post_data['usernameOREmail']);

        $success = $merchant->cancelDeliveryRequest($args['id'], $merchant_id);

        if($success) {
            $response->getBody()->write(json_encode(array("Success" => $success, "data" => "Delivery Request Canceled", "Status Code" => \http_response_code(201))));
            return $response->withHeader("Content-Type","application/json");
        } 

       
    })->add(new CancelDeliveryRequestMiddleware());

    // Track Delivery Request Status
    $group->get('/track/{id}',function (Request $request,Response $response, $args) {
        $database = new Database();
        $merchant = new Merchant_Model($database);
        $delivery_status = $merchant->track(intval($args['id']));
        $response->getBody()->write(json_encode(array("Success" => true, "Status Code" => \http_response_code(200),"Delivery Status" => $delivery_status), JSON_PRETTY_PRINT));
        return $response->withHeader("Content-Type", "application/json"); 
    })->add(new TrackMiddleWare());

    // Login Merchant
    $group->post('/auth/login', function (Request $request, Response $response, $args) {
            
            $token = new Token;
            $userId = 2587258272;
            $secret = 'ede!VerY25*&';
            $expiration = time() + 3600;
            $issuer = 'localhost';

            $token = Token::create($userId, $secret, $expiration, $issuer);

            $response->getBody()->write(json_encode(array("Login" => "Successful", "JWT" => $token, "Status Code" => \http_response_code(200))));
            return $response->withHeader("Content-Type", "application/json");    
    })->add(new LoginMiddleware());

    // Login Merchant
    $group->post('/internal/login', function (Request $request, Response $response, $args) {
            
        $token = new Token;
        $userId = 2587258272;
        $secret = 'ede!VerY25*&';
        $expiration = time() + 3600;
        $issuer = 'localhost';

        $token = Token::create($userId, $secret, $expiration, $issuer);

        $response->getBody()->write(json_encode(array("Login" => "Successful", "JWT" => $token, "Status Code" => \http_response_code(200))));
        $response = $response->withHeader("Content-Type", "application/json");
        $response = $response->withHeader('Access-Control-Allow-Origin', '*');

        return $response;
    })->add(new InternalLoginMiddleware());

});



// Add Error Middleware
$errorMiddleware = $app->addErrorMiddleware(true, true, true);


// Get the default error handler and register my custom error renderer.
$errorHandler = $errorMiddleware->getDefaultErrorHandler();
$errorHandler->registerErrorRenderer('application/json', new RouteErrorHandler());
$errorHandler->forceContentType('application/json');

$app->run();