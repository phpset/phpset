<?php return [
    new \FastRouteMiddleware\Router(require __DIR__ . '/routes.php', '\App\Controllers\NotFoundController::showMessage'),
    new \App\Http\Middleware\RequestHandlerMiddleware(),
];