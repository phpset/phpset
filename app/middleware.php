<?php return [
    new FastRouteMiddleware(require __DIR__ . '/routes.php', '\App\Http\Controllers\NotFoundController::showMessage'),
    new \App\Http\Middleware\RequestHandlerMiddleware(),
];