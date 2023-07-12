<?php

declare(strict_types=1);

namespace App\http\routes;

use App\http\controler\TestControler;
use Slim\App;

return function (App $app): void {
    $app->get('/', TestControler::class);
};
