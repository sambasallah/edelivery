<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use edelivery\api\v1\middleware\RouteErrorHandler;
use Slim\Routing\RouteCollectorProxy;

use edelivery\api\v1\database\Database;
use edelivery\api\v1\models\Merchant_Model;
use edelivery\api\v1\middleware\LoginMiddleware;
use edelivery\api\v1\middleware\MakeRequestMiddleware;
use edelivery\api\v1\middleware\TrackMiddleWare;

require '../../vendor/autoload.php';
require 'init/init.php';

$app = AppFactory::create();

$app->group('/api/v1', function (RouteCollectorProxy $group) {
    // Make Delivery Request
    $group->post('/make-request',function (Request $request,Response $response, $args) {
        $response->getBody()->write(json_encode(array("Error" => "Invalid Authorization token")));
        return $response->withHeader("Content-Type","application/json");
    })->add(new MakeRequestMiddleware());

    // Track Delivery Request Status
    $group->get('/track/{id}',function (Request $request,Response $response, $args) {
        $response->getBody()->write(json_encode(array("Error" => "Invalid Authorization token")));
        return $response->withHeader("Content-Type","application/json");
    })->add(new TrackMiddleWare());

    // Login Merchant
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