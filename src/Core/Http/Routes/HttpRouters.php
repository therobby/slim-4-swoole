<?php

declare(strict_types=1);

namespace Application\Core\Http\Routes;

use Application\App\Http\Routes\HttpRouter;
use Psr\Container\ContainerInterface;
use Slim\App;

class HttpRouters
{
    /**
     * @param App<?ContainerInterface> $app
     */
    public static function registerRouters(App $app): void
    {
        HttpRouter::registerRoutes($app);
    }
}
