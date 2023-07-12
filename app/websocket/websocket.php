<?php

declare(strict_types=1);

use App\websocket\WebsocketResponse;
use Swoole\WebSocket\Server;

return function (Server $server): void {
    $server->on('message', new WebsocketResponse());
};
