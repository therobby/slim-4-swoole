<?php

declare(strict_types=1);

namespace Application\Core\Http\Handle;

use Psr\Container\ContainerInterface;
use Slim\App;
use Swoole\WebSocket\Server;

abstract class AbstractHttpHandler
{
    /**
     * @param App<?ContainerInterface> $app
     * @param Server $server
     */
    abstract public function handle(App $app, Server $server): void;
}
