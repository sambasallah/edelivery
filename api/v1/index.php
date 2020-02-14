<?php

require '../../vendor/autoload.php';
require 'init/init.php';

use edelivery\api\v1\controllers\AuthController;
use Slim\Factory\AppFactory;
use edelivery\api\v1\middleware\RouteErrorHandler;
use Slim\Routing\RouteCollectorProxy;
use edelivery\api\v1\middleware\CancelDeliveryRequestMiddleware;
use edelivery\api\v1\middleware\LoginMiddleware;
use edelivery\api\v1\middleware\MakeRequestMiddleware;
use edelivery\api\v1\middleware\TrackMiddleWare;
use edelivery\api\v1\controllers\RequestController;
use edelivery\api\v1\controllers\CancelDeliveryRequestController;
use edelivery\api\v1\controllers\InternalAuthController;
use edelivery\api\v1\controllers\TrackDeliveryController;

$app = AppFactory::create();

$app->group('/api/v1', function (RouteCollectorProxy $group) {
    
    // Make Delivery Request
    $group->post('/request', RequestController::class)->add(new MakeRequestMiddleware());

    // Cancel Delivery Request
    $group->post('/cancel/{id}',CancelDeliveryRequestController::class)->add(new CancelDeliveryRequestMiddleware());

    // Track Delivery Request Status
    $group->get('/track/{id}', TrackDeliveryController::class)->add(new TrackMiddleWare());

    // Login Merchant
    $group->post('/auth/login',AuthController::class)->add(new LoginMiddleware());

    // Login Merchant
    $group->get('/internal/login', InternalAuthController::class);

});



// Add Error Middleware
$errorMiddleware = $app->addErrorMiddleware(true, true, true);


// Get the default error handler and register my custom error renderer.
$errorHandler = $errorMiddleware->getDefaultErrorHandler();
$errorHandler->registerErrorRenderer('application/json', new RouteErrorHandler());
$errorHandler->forceContentType('application/json');

$app->run();