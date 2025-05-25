<?php declare(strict_types=1);

namespace KgBot\TikFinityWebhooks\Pipes;

use Closure;
use KgBot\TikFinityWebhooks\Contracts\PipeContract;
use KgBot\TikFinityWebhooks\DTO\WebhookData;
use KgBot\TikFinityWebhooks\Exceptions\ProfileBanned;

final class SkipIfProfileIsBanned implements PipeContract
{
    /**
     * @throws ProfileBanned
     */
    public function handle(WebhookData $webhookData, Closure $next): mixed
    {
        if($webhookData->user()->isBanned()) {

            throw new ProfileBanned('Profile is banned');
        }

        return $next($webhookData);
    }
}
