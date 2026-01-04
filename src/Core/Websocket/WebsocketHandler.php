<?php

declare(strict_types=1);

namespace Application\Core\Websocket;

use Application\App\Websocket\WebsocketResponse;
use Swoole\WebSocket\Server;

class WebsocketHandler
{
    public static function handleWebsocket(Server $server): void
    {
        $server->on('message', new WebsocketResponse());
    }
}
