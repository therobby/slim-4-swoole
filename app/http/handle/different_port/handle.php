<?php

declare(strict_types=1);

namespace App\http\handle\different_port;

use Swoole\Http\Request;
use Swoole\Http\Response;
use Imefisto\PsrSwoole\ResponseMerger;
use Nyholm\Psr7\Factory\Psr17Factory;
use Imefisto\PsrSwoole\ServerRequest as PsrRequest;
use Swoole\WebSocket\Server;
use Slim\App;

return function (Server $server, App $app): void {
    $http = $server->listen($_ENV['HTTP_HOST'], $_ENV['HTTP_PORT'], SWOOLE_BASE);

    $uriFactory = new Psr17Factory;
    $streamFactory = new Psr17Factory;
    $uploadedFileFactory = new Psr17Factory;
    $responseMerger = new ResponseMerger;

    $http->on(
        'request',
        function (
            Request $swooleRequest,
            Response $swooleResponse
        ) use (
            $uriFactory,
            $streamFactory,
            $uploadedFileFactory,
            $responseMerger,
            $app
        ) {
            /**
             * Create psr request from swoole request
             */
            $psrRequest = new PsrRequest(
                $swooleRequest,
                $uriFactory,
                $streamFactory,
                $uploadedFileFactory
            );
        
            /**
             * Process request (here is where slim handles the request)
             */
            $psrResponse = $app->handle($psrRequest);
        
            /**
             * Merge your psr response with swoole response
             */
            $responseMerger->toSwoole(
                $psrResponse,
                $swooleResponse
            )->end();
        }
    );
};
