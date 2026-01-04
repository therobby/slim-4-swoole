<?php

namespace Application\App\Http\Routes;

use Application\App\Http\Controller\TestController;
use Application\Core\Http\Routes\AbstractRouter;
use Psr\Container\ContainerInterface;
use Slim\App;

class HttpRouter extends AbstractRouter
{
    /**
     * @param App<?ContainerInterface> $app
     */
    public static function registerRoutes(App $app): void
    {
        $app->get('/', TestController::class);
    }
}
