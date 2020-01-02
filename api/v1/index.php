<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use edelivery\api\v1\middleware\RouteErrorHandler;
use Slim\Routing\RouteCollectorProxy;

use edelivery\api\v1\database\Database;
use edelivery\api\v1\models\Merchant_Model;
use edelivery\api\v1\middleware\LoginMiddleware;


require '../../vendor/autoload.php';
require 'init/init.php';

$app = AppFactory::create();

$app->group('/api/v1', function (RouteCollectorProxy $group) {
    $group->post('/make_request',function (Request $request,Response $response, $args) {
        
        
        $response->getBody()->write(json_encode($data));
        return $response->withHeader("Content-Type","application/json");
    });
    
    $group->get('/track/{request_id:[0-9]+}', function ($request, $response, $args) {
        $database = new Database();
        $merchant = new Merchant_Model($database);
        $request_status = $merchant->track($args['request_id']);
        $response->getBody()->write(json_encode(array("Delivery Status" => $request_status, "Status Code" => http_response_code())));
        return $response->withHeader("Content-Type","application/json");
    });
    $group->post('/login-merchant', function (Request $request, Response $response, $args) {
        $response->getBody()->write(json_encode(array("Error" => "Invalid Login Credentials")));
        return $response->withHeader("Content-Type","application/json");
      
    })->add(new LoginMiddleware());
});

// Add Error Middleware
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// Get the default error handler and register my custom error renderer.
$errorHandler = $errorMiddleware->getDefaultErrorHandler();
$errorHandler->registerErrorRenderer('application/json', new RouteErrorHandler());
$errorHandler->forceContentType('application/json');

$app->run();