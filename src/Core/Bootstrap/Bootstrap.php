<?php

declare(strict_types=1);

namespace Application\Core\Bootstrap;

use Application\Core\Application;
use Application\Core\Setup\Setup;
use Application\Core\Server;
use Slim\Factory\AppFactory;
use Swoole\WebSocket\Server as SwooleWebSocketServer;

class Bootstrap
{
    public static function setup(): void
    {
        $serverApp = AppFactory::create();
        $app = new Application(
            $serverApp
        )->getApp();

        $server = new Server(
            new SwooleWebSocketServer(
                $_ENV['WEBSOCKET_HOST'],
                intval($_ENV['WEBSOCKET_PORT']),
                intval(SWOOLE_BASE)
            )
        )->getServer();
        $server->set(
            [
                'open_http2_protocol' => true
            ]
        );

        Setup::setupRoutes($app, $server);
        Setup::setupPorts($app, $server);
        Setup::setupErrors($app);
        Setup::setupServerEvents($server);
    }
}
