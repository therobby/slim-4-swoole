<?php

declare(strict_types=1);

namespace Application\Core\Http\Handle\DifferentPort;

use Application\Core\Http\Handle\AbstractHttpHandler;
use Imefisto\PsrSwoole\ResponseMerger;
use Imefisto\PsrSwoole\ServerRequest as PsrRequest;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Container\ContainerInterface;
use Slim\App;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\WebSocket\Server;

class DifferentPortHandle extends AbstractHttpHandler
{
    /**
     * @param App<?ContainerInterface> $app
     * @param Server $server
     */
    public function handle(App $app, Server $server): void
    {
        $http = $server->listen($_ENV['HTTP_HOST'], intval($_ENV['HTTP_PORT']), intval(SWOOLE_BASE));

        $uriFactory = new Psr17Factory();
        $streamFactory = new Psr17Factory();
        $uploadedFileFactory = new Psr17Factory();
        $responseMerger = new ResponseMerger();

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
    }
}
