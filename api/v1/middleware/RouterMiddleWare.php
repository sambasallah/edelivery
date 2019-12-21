<?php

namespace edelivery\api\v1\middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
// use Psr\Http\Message\ResponseInterface as Response;
use Slim\Psr7\Response;

class RouterMiddleware
{

    //Add your constructor class if necessary

    public function __invoke(Request $request, Response $response, $next)
    {
        $route = $request->getAttribute('route');
        if(!$route){
            $response->getBody()->write(json_encode(array("Invalid Route" => "The route does not exist"),JSON_PRETTY_PRINT));
            return $response->withHeader("Content-Type","application/json");
        }
        return $next($request, $response);
    }
}