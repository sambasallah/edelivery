<?php

namespace edelivery\api\v1\middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use edelivery\api\v1\database\Database;
use edelivery\api\v1\models\Merchant_Model;


class InternalLoginMiddleware {

    public function __invoke(Request $request, RequestHandler $handler): Response {
        $response = $handler->handle($request);
        $existingContent = (string) $response->getBody();
        
        $response = new Response();

        $contentType = $request->getHeaderLine('Content-Type');

        if (strstr($contentType, 'application/json')) {     
            if (json_last_error() === JSON_ERROR_NONE) {
                
                $post_data = json_decode(file_get_contents('php://input'), true);

                $database = new Database();
                $merchant = new Merchant_Model($database);

                if($merchant->validateInterUser($post_data)) {
                    $response->getBody()->write($existingContent);
                    return $response->withHeader("Content-Type", "application/json");
                }
            }
        }
        
        $response->getBody()->write(json_encode(array("Error" => "Invalid Login Credentials")));
        return $response->withHeader("Content-Type","application/json");
        
        
    }
}