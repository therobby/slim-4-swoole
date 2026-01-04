<?php

declare(strict_types=1);

namespace Application\Core\Setup;

use Application\Core\Http\Handle\DifferentPort\DifferentPortHandle;
use Application\Core\Http\Routes\HttpRouters;
use Application\Core\Websocket\WebsocketHandler;
use Psr\Container\ContainerInterface;
use Slim\App;
use Swoole\WebSocket\Server;

class Setup
{
    /**
     * @param App<?ContainerInterface> $app
     * @param Server $server
     */
    public static function setupRoutes(App $app, Server $server): void
    {
        HttpRouters::registerRouters($app);
        WebsocketHandler::handleWebsocket($server);
    }

    /**
     * @param App<?ContainerInterface> $app
     * @param Server $server
     */
    public static function setupPorts(App $app, Server $server): void
    {
//        $portHandle = new SamePortHandle();
        $portHandle = new DifferentPortHandle();
        $portHandle->handle($app, $server);
    }

    /**
     * @param App<?ContainerInterface> $app
     */
    public static function setupErrors(App $app): void
    {
        $app->addErrorMiddleware(true, true, true);
    }

    /**
     * @param Server $server
     */
    public static function setupServerEvents(Server $server): void
    {
        $server->on(
            'Start',
            function ($server) {
                error_log(
                    '🚀  Server has started on '
                    . $server->host
                    . ':'
                    . $server->port
                    . ' 🚀'
                );
            }
        );
    }
}
