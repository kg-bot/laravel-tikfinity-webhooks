<?php declare(strict_types=1);

namespace KgBot\TikFinityWebhooks\DTO;

use Closure;
use Illuminate\Http\Request;
use KgBot\TikFinityWebhooks\Contracts\TikTokProfileContract;

/**
 * Extract OOP properties from the request
 * Request could be in one of the formats
 *
 * {
 * "value1": "user123",
 * "value2": "Hello World",
 * "value3": null,
 * "content": "Hello World",
 * "avatar_url": "https://p16-va.tiktokcdn.com/tos-maliva-avt-0068/06997783b9e87970a5b0f1o9a6691996~tplv-tiktokx-cropcenter:100:100.webp",
 * "userId": "6915820862987355973",
 * "username": "user123",
 * "nickname": "User 123",
 * "commandParams": "Hello World",
 * "giftId": null,
 * "triggerTypeId": "2",
 * "tikfinityUserId": "1229879",
 * "tikfinityUsername": "user123",
 * "token": "AkxWIIcl3525hFImBWy0EgAzcg5joGY22BJ9YLYDiOaOYhIla5mxTG5w9uGFvjEHL0uZXDvDLXDOk0vrPYS7wi5E7WJAK9XwhX81EP"
 * }
 *
 * and
 *
 * {
 * "value1": "user123",
 * "value2": null,
 * "value3": "5655",
 * "content": "TikTok Gift Webhook",
 * "avatar_url": "https://p16-pu-no.tiktokcdn-eu.com/tos-no1a-avt-0068c001-no/06997783b9e87970a5b0f1o9a6691996~tplv-tiktokx-cropcenter:100:100.webp",
 * "userId": "6915820862987355973",
 * "username": "user123",
 * "nickname": "User 123",
 * "commandParams": null,
 * "giftId": "5655",
 * "giftName": "Rose",
 * "coins": "22",
 * "repeatCount": "22",
 * "triggerTypeId": "3",
 * "tikfinityUserId": "1229909",
 * "tikfinityUsername": "user123",
 * "token": "AkxWIIcl3525hFImBWy0EgAzcg5joGY22BJ9YLYDiOaOYhIla5mxTG5w9uGFvjEHL0uZXDvDLXDOk0vrPYS7wi5E7WJAK9XwhX81EP"
 * }
 */
class WebhookData
{
    private static ?Closure $createTikTokProfileUsing = null;

    public function __construct(private readonly Request $request)
    {
    }

    public function username(): ?string
    {
        return $this->request->input('username');
    }

    public function host(): string
    {
        return $this->request->host();
    }

    public function nickname(): ?string
    {
        return $this->request->input('nickname');
    }

    public function userId(): ?int
    {
        return (int) $this->request->input('userId');
    }

    public function avatarUrl(): ?string
    {
        return $this->request->input('avatarUrl');
    }

    public function event(): ?string
    {
        return $this->request->input('content');
    }

    public function isGiftEvent(): bool
    {
        return $this->request->input('giftId') !== null;
    }

    public function giftId(): ?int
    {
        return $this->request->input('giftId');
    }

    public function giftName(): ?string
    {
        return $this->request->input('giftName');
    }

    public function repeatCount(): ?int
    {
        return $this->request->input('repeatCount');
    }

    public static function createProfileUsing(Closure $closure): void
    {
        self::$createTikTokProfileUsing = $closure;
    }

    public function coins(): int
    {
        return (int) $this->request->input('coins', 0);
    }

    public function comment(): ?string
    {
        return $this->request->input('commandParams');
    }

    public function user(): ?TikTokProfileContract
    {
        if(self::$createTikTokProfileUsing) {
            return call_user_func(self::$createTikTokProfileUsing, $this->request);
        }

        return config('tikfinity-webhooks.model')::query()
            ->firstOrCreate([
                'user_id' => $this->userId(),
                'username' => $this->username(),
                'nickname' => $this->nickname(),
            ])->refresh();
    }

    public function request(): Request
    {
        return $this->request;
    }

    public function __get(string $key): mixed
    {
        if(method_exists($this, $key)) {
            return $this->$key();
        }

        return $this->request->input($key);
    }
}