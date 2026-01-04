<?php

declare(strict_types=1);

namespace Application\Core;

final class Server
{
    private static ?self $instance = null;
    public function __construct(private readonly \Swoole\WebSocket\Server $server)
    {
        if (self::$instance === null) {
            self::$instance = $this;
        }
    }

    public static function getInstance(): ?self
    {
        return self::$instance;
    }

    public function getServer(): \Swoole\WebSocket\Server
    {
        return $this->server;
    }
}
