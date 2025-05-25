<?php

namespace KgBot\TikFinityWebhooks;

use Illuminate\Support\ServiceProvider;

class TikFinityWebhooksServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/tikfinity-webhooks.php' => config_path('tikfinity-webhooks.php'),
        ], 'tikfinity-webhooks-config');

        $this->publishesMigrations([
            __DIR__ . '/../database/migrations/' => database_path('migrations'),
        ], 'tikfinity-webhooks-migrations');

        $this->loadRoutesFrom( __DIR__ . '/../routes/webhooks.php');
    }
}