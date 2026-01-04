<?php

declare(strict_types=1);

namespace Application\App\Http\Controller;

use Imefisto\PsrSwoole\ServerRequest as Request;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractController
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
