<?php

declare(strict_types=1);

namespace Application\Core;

use Psr\Container\ContainerInterface;
use Slim\App;

final class Application
{
    private static ?self $instance = null;

    /**
     * @param App<?ContainerInterface> $app
     */
    public function __construct(private readonly \Slim\App $app)
    {
        if (self::$instance === null) {
            self::$instance = $this;
        }
    }

    public static function getInstance(): ?self
    {
        return self::$instance;
    }

    /**
     * @return App<?ContainerInterface>
     */
    public function getApp(): \Slim\App
    {
        return $this->app;
    }
}
