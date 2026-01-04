<?php

/**
 * Template for Slim 4 microframework with swoole
 *
 * PHP version 8.4
 *
 * @category Microframework
 * @package  Slim4Swoole-Template
 * @author   therobby <therobby@github.com>
 * @license  MIT https://opensource.org/license/mit/
 * @link     none
 */

declare(strict_types=1);

use Application\Core\Bootstrap\Bootstrap;
use Application\Core\Server;
use Dotenv\Dotenv;

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

Bootstrap::setup();
Server::getInstance()?->getServer()?->start();
