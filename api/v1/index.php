<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use edelivery\api\v1\middleware\RouteErrorHandler;
use Slim\Routing\RouteCollectorProxy;

require '../../vendor/autoload.php';

$app = AppFactory::create();

$app->group('/api/v1', function (RouteCollectorProxy $group) {
    $group->post('/make_request',function (Request $request,Response $response, $args) {
        $response->getBody()->write(json_encode(array("make_request" => "Endpoint working correctly")));
        return $response->withHeader("Content-Type","application/json");
    });
    
    $group->post('/track/{request_id:[0-9]+}', function ($request, $response, $args) {
        $response->getBody()->write(json_encode(array("Tracking Endpoint" => "Your tracking endpoint test is working with request id=".$args['request_id'])));
        return $response->withHeader("Content-Type","application/json");
    });
});

// Add Error Middleware
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// Get the default error handler and register my custom error renderer.
$errorHandler = $errorMiddleware->getDefaultErrorHandler();
$errorHandler->registerErrorRenderer('application/json', new RouteErrorHandler());
$errorHandler->forceContentType('application/json');

$app->run();