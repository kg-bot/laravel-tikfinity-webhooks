<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use KgBot\TikFinityWebhooks\Http\Controllers\CommentController;
use KgBot\TikFinityWebhooks\Http\Controllers\GiftController;

Route::middleware(config('tikfinity-webhooks.routes.middlewares', []))
    ->prefix(config('tikfinity-webhooks.routes.prefix', 'tikfinity-webhooks'))
    ->name(config('tikfinity-webhooks.routes.name', 'tikfinity-webhooks.'))
    ->group(function () {
        Route::any('/comment', CommentController::class)
            ->name('comment');

        Route::any('/gift', GiftController::class)
            ->name('gift');
    });
