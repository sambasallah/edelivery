<?php

namespace edelivery\api\v1\middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use ReallySimpleJWT\Token;

class CancelDeliveryRequestMiddleware {

    public function __invoke(Request $request, RequestHandler $handler) : Response {   
        $response = $handler->handle($request);
        $existingContent = (string) $response->getBody();
        $response = new Response();

        if($request->hasHeader("Authorization")) {
            $token = $request->getHeaderLine("Authorization");

            $secret = 'ede!VerY25*&';

            $valid = Token::validate($token,$secret);

            if($valid) {
                $response->getBody()->write($existingContent);
                return $response->withHeader("Content-Type", "application/json");  
            }
        }

        $response->getBody()->write(json_encode(array("Error" => "Invalid Authorization token")));
        return $response->withHeader("Content-Type","application/json");

        
    }
}