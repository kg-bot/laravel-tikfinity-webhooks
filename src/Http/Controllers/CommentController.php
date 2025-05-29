<?php declare(strict_types=1);

namespace KgBot\TikFinityWebhooks\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Pipeline;
use KgBot\TikFinityWebhooks\DTO\WebhookData;

class CommentController extends Controller
{
    public function __invoke(WebhookData $webhookData)
    {
        Pipeline::send($webhookData)
            ->through(config('tikfinity-webhooks.pipes.comment', []))
            ->thenReturn();
    }
}