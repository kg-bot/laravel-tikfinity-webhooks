<?php declare(strict_types=1);

namespace KgBot\TikFinityWebhooks\Models;

use Illuminate\Database\Eloquent\Model;
use KgBot\TikFinityWebhooks\Contracts\TikTokProfileContract;

/**
 * @property int $id
 * @property int $user_id
 * @property string $username
 * @property string $nickname
 * @property bool $is_banned
 */
class TiktokProfile extends Model implements TikTokProfileContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'username',
        'nickname',
        'is_banned',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_banned' => 'boolean',
        ];
    }

    public function isBanned(): bool
    {
        return $this->is_banned;
    }
}