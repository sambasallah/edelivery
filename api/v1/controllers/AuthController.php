<?php


namespace edelivery\api\v1\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use edelivery\api\v1\models\Merchant_Model;
use edelivery\api\v1\database\Database;
use ReallySimpleJWT\Token;

class AuthController {

    public function __invoke(Request $request, Response $response, $args) {
            $token = new Token;
            $userId = 2587258272;
            $secret = 'ede!VerY25*&';
            $expiration = time() + 3600;
            $issuer = 'localhost';

            $token = Token::create($userId, $secret, $expiration, $issuer);

            $response->getBody()->write(json_encode(array("Login" => "Successful", "JWT" => $token, "Status Code" => \http_response_code(200))));
    }
}