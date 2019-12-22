<?php

namespace edelivery\api\v1\middleware;

use Slim\Interfaces\ErrorRendererInterface;

class RouteErrorHandler implements ErrorRendererInterface
{
    public function __invoke(\Throwable $exception, bool $displayErrorDetails): string
    {
        return json_encode(array("error" => "Endpoint Not Found"));
    }
}