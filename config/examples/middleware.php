<?php return [
    // Cross-domain headers
    new \App\HttpMiddleware\CorsMiddleware(),

    // your middleware

    // Router
    new \FastRouteMiddleware\Router(require __DIR__ . '/routes.php', '\App\Controllers\NotFoundController::showMessage'),
    // calling Controller
    new \App\HttpMiddleware\RequestHandlerMiddleware(),
];