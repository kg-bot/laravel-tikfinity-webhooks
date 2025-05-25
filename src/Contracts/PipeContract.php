<?php declare(strict_types=1);

namespace KgBot\TikFinityWebhooks\Contracts;

use Closure;
use KgBot\TikFinityWebhooks\DTO\WebhookData;

interface PipeContract
{
    public function handle(WebhookData $webhookData, Closure $next): mixed;
}