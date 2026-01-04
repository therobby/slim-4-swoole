<?php

declare(strict_types=1);

namespace Application\Core\Http\Handle\SamePort;

use Application\Core\Http\Handle\AbstractHttpHandler;
use Exception;
use Imefisto\PsrSwoole\ResponseMerger;
use Imefisto\PsrSwoole\ServerRequest as PsrRequest;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response as Psr7Response;
use Psr\Container\ContainerInterface;
use Slim\App;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\WebSocket\Server;

class SamePortHandle extends AbstractHttpHandler
{
    /**
     * @param App<?ContainerInterface> $app
     * @param Server $server
     */
    public function handle(App $app, Server $server): void
    {
        $uriFactory = new Psr17Factory();
        $streamFactory = new Psr17Factory();
        $uploadedFileFactory = new Psr17Factory();
        $responseMerger = new ResponseMerger();

        $server->on(
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
                try {
                    $psrResponse = $app->handle($psrRequest);
                } catch (Exception $e) {
                    $psrResponse = new Psr7Response($e->getCode());
                }
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
