<?php
/**
 * Template for Slim 4 microframework with swoole
 * 
 * PHP version 8.1
 * 
 * @category Microframework
 * @package  Slim4Swoole-Template
 * @author   therobby <therobby@github.com>
 * @license  MIT https://opensource.org/license/mit/
 * @link     none
 */

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use Slim\Factory\AppFactory;

// https://openswoole.com/article/swoole-and-psr

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$app = AppFactory::create();

$server = new Swoole\WebSocket\Server(
    $_ENV['WEBSOCKET_HOST'],
    $_ENV['WEBSOCKET_PORT'],
    SWOOLE_BASE
);
$server->set(
    [
        'open_http2_protocol' => true
    ]
);

$routes = include_once __DIR__ . '/app/http/routes/routes.php';
$routes($app);

$websocket = include_once __DIR__ . '/app/websocket/websocket.php';
$websocket($server);

// http on the same port as websocket
$handleSamePort = include_once __DIR__ . '/app/http/handle/same_port/handle.php';
$handleSamePort($server, $app);
// http on different port as websocket
// $handleDifferentPort = include_once __DIR__
//     . '/app/http/handle/different_port/handle.php';
// $handleDifferentPort($server, $app);

$server->on(
    'Start',
    function ($server) {
        error_log(
            '🚀  Server has started on '
            . $server->host
            . ':'
            . $server->port
            . ' 🚀'
        );
    }
);

$server->start();
