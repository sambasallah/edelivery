<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use edelivery\api\v1\middleware\MiddleWare;
use edelivery\api\v1\middleware\RouterMiddleWare;

require '../../vendor/autoload.php';

$app = AppFactory::create();


$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("This is the home route");
    return $response;
});

$app->get('/track/{id}', function (Request $request, Response $response, $args) {
    $msg = json_encode(array("tracking_id" => $args['id'],"item_name" => "Television","item_price" => "3000"),JSON_PRETTY_PRINT);
    $response->getBody()->write($msg);
    return $response->withHeader('Content-Type', 'application/json;charset=UTF-8');
});

$app->add(new RouterMiddleWare());

$app->run();