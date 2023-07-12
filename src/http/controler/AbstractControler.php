<?php

declare(strict_types=1);

namespace App\http\controler;

use Psr\Http\Message\ResponseInterface;
use Imefisto\PsrSwoole\ServerRequest as Request;

abstract class AbstractControler
{
    /**
     * Abstract controler
     * 
     * @param Request           $request
     * @param ResponseInterface $response
     * @param array<string>     $args
     * 
     * @return ResponseInterface
     */
    abstract public function __invoke(
        Request $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface;
}
