<?php

declare(strict_types=1);

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

use Hyperf\HttpServer\Router\Router;

$routeFiles = scandir(__DIR__ . '/Routes/');

foreach ($routeFiles as $file) {
    include(__DIR__ . '/Routes/' . $file);

    if (!empty($postRoutes)) {
        foreach ($postRoutes as $route => $controller) {
            $prefix = current(explode('.', $file));
            Router::post('/' . $prefix . '/' . $route, 'App\Controller\Group\\' . $controller . '@index');
        }
    }

    if (!empty($getRoutes)) {
        foreach ($getRoutes as $route => $controller) {
            $prefix = current(explode('.', $file));
            Router::get('/' . $prefix . '/' . $route, 'App\Controller\Group\\' . $controller . '@index');
        }
    }
}
