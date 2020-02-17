<?php

namespace edelivery\api\v1\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use ReallySimpleJWT\Token;


class InternalAuthController {

    public function __invoke(Request $request, Response $response, $args)
    {
        $token = new Token;
        $userId = 2587258272;
        $secret = 'ede!VerY25*&';
        $expiration = time() + 3600;
        $issuer = 'localhost';

        $token = Token::create($userId, $secret, $expiration, $issuer);

        $response->getBody()->write(json_encode(array("JWT" => $token),JSON_PRETTY_PRINT));
        $response = $response->withHeader("Content-Type", "application/json");
        $response = $response->withHeader('Access-Control-Allow-Origin', '*');

        return $response;
    }
}