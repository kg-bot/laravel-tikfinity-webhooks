<?php

return [
    'model' => KgBot\TikFinityWebhooks\Models\TiktokProfile::class,

    'migrations' => [
        'execute' => true,
    ],

    'routes' => [
        'prefix' => 'tikfinity-webhooks',
        'name' => 'tikfinity-webhooks.',
        'middlewares' => [
            'web',
            \KgBot\TikFinityWebhooks\Http\Middleware\VerifyTikTokWebhookMiddleware::class
        ],
    ],

    'pipes' => [
        'comment' => [
            \KgBot\TikFinityWebhooks\Pipes\SkipIfProfileIsBanned::class,
        ],
        'gift' => [
            \KgBot\TikFinityWebhooks\Pipes\VerifyGiftWebhook::class,
            \KgBot\TikFinityWebhooks\Pipes\SkipIfProfileIsBanned::class,
        ],
    ],

    /**
     * Token to verify that the request is coming from Authorized TikFinity webhook
     */
    'token' => env('TIKTOK_WEBHOOK_TOKEN', 'AkxWIIcl3525hFImBWy0EgAzcg5joGY22BJ9YLYDiOaOoyhjp5mxTG5w9uGFvjEHL0uZXDvDLXDOk0vrPYS7wi5E7WJAK9XwhX81EP'),
];