<?php declare(strict_types=1);

namespace KgBot\TikFinityWebhooks\Pipes;

use Closure;
use KgBot\TikFinityWebhooks\Contracts\PipeContract;
use KgBot\TikFinityWebhooks\DTO\WebhookData;
use KgBot\TikFinityWebhooks\Exceptions\EventNotAllowed;

final class VerifyGiftWebhook implements PipeContract
{
    /**
     * @throws EventNotAllowed
     */
    public function handle(WebhookData $webhookData, Closure $next): mixed
    {
        if(!$webhookData->isGiftEvent()) {
            throw new EventNotAllowed('Event is not a gift event');
        }

        return $next($webhookData);
    }
}
