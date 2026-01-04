<?php

declare(strict_types=1);

namespace Application\App\Websocket;

use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;

class WebsocketResponse
{
    /**
     * Response to websocket message
     *
     * @param Server $server
     * @param Frame  $frame
     *
     * @return void
     */
    public function __invoke(
        Server $server,
        Frame $frame
    ): void {
        $server->push($frame->fd, 'Hello ' . $frame->data);
    }
}
