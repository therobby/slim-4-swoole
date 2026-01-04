<?php

declare(strict_types=1);

namespace Application\Core\Http\Routes;

use Psr\Container\ContainerInterface;
use Slim\App;

abstract class AbstractRouter
{
    /**
     * @param App<?ContainerInterface> $app
     */
    abstract public static function registerRoutes(App $app): void;
}
