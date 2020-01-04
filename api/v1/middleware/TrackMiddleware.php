<?php 

namespace edelivery\api\v1\middleware;


use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use edelivery\api\v1\database\Database;
use edelivery\api\v1\models\Merchant_Model;
use ReallySimpleJWT\Token;

class TrackMiddleWare {
   
    public function __invoke(Request $request, RequestHandler $handler) : Response {

        $response = $handler->handle($request);
        $existingContent = (string) $response->getBody();
        $response = new Response();

        if($request->hasHeader("Authorization")) {
            $database = new Database();

            $merchant = new Merchant_Model($database);

            $token = $request->getHeaderLine("Authorization");

            $secret = 'ede!VerY25*&';

            $valid = Token::validate($token,$secret);

            if($valid) {
                $route = $request->getAttribute("route");
                $request_id = $route->getArgument("id");
                $delivery_status = $merchant->track(intval($request_id));
                $response->getBody()->write(json_encode(array("Success" => true, "Status Code" => \http_response_code(),"Delivery Status" => $delivery_status)));
                return $response->withHeader("Content-Type", "application/json"); 
            }

        }

        $response->getBody()->write($existingContent);
        return $response->withHeader("Content-Type", "application/json"); 
    }
    
}