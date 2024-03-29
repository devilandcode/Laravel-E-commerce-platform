<?php

namespace App\Models\Banner;

use App\Models\Adverts\Category;
use App\Models\Region;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * App\Models\Banner\Banner
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property int|null $region_id
 * @property string $name
 * @property int|null $views
 * @property int $limit
 * @property int|null $clicks
 * @property int|null $cost
 * @property string $url
 * @property string $format
 * @property string $file
 * @property string $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $published_at
 * @property-read Category|null $category
 * @property-read Region|null $region
 * @property-read User|null $user
 * @method static Builder|Banner active()
 * @method static Builder|Banner forUser(\App\Models\User\User $user)
 * @method static Builder|Banner newModelQuery()
 * @method static Builder|Banner newQuery()
 * @method static Builder|Banner query()
 * @method static Builder|Banner whereCategoryId($value)
 * @method static Builder|Banner whereClicks($value)
 * @method static Builder|Banner whereCost($value)
 * @method static Builder|Banner whereCreatedAt($value)
 * @method static Builder|Banner whereFile($value)
 * @method static Builder|Banner whereFormat($value)
 * @method static Builder|Banner whereId($value)
 * @method static Builder|Banner whereLimit($value)
 * @method static Builder|Banner whereName($value)
 * @method static Builder|Banner wherePublishedAt($value)
 * @method static Builder|Banner whereRegionId($value)
 * @method static Builder|Banner whereStatus($value)
 * @method static Builder|Banner whereUpdatedAt($value)
 * @method static Builder|Banner whereUrl($value)
 * @method static Builder|Banner whereUserId($value)
 * @method static Builder|Banner whereViews($value)
 * @mixin \Eloquent
 */
class Banner extends Model
{
    use HasFactory;

    public const STATUS_DRAFT = 'draft';
    public const STATUS_MODERATION = 'moderation';
    public const STATUS_MODERATED = 'moderated';
    public const STATUS_ORDERED = 'ordered';
    public const STATUS_ACTIVE = 'active';
    public const STATUS_CLOSED = 'close';

    protected $table = 'banner_banners';

    protected $guarded = ['id'];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public static function statusesList(): array
    {
        return [
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_MODERATION => 'On Moderation',
            self::STATUS_MODERATED => 'moderated',
            self::STATUS_ORDERED => 'Payment',
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_CLOSED => 'Closed',
        ];
    }

    public static function formatsList(): array
    {
        return [
            '240x400',
        ];
    }

    public function view(): void
    {
        $this->assertIsActive();
        $this->views++;
        if ($this->views >= $this->limit) {
            $this->status = self::STATUS_CLOSED;
        }
        $this->save();
    }

    public function click(): void
    {
        $this->assertIsActive();
        $this->clicks++;
        $this->save();
    }

    public function sendToModeration(): void
    {
        if (!$this->isDraft()) {
            throw new \DomainException('Advert is not draft.');
        }
        $this->update([
            'status' => self::STATUS_MODERATION,
        ]);
    }

    public function cancelModeration(): void
    {
        if (!$this->isOnModeration()) {
            throw new \DomainException('Advert is not sent to moderation.');
        }
        $this->update([
            'status' => self::STATUS_DRAFT,
        ]);
    }

    public function moderate(): void
    {
        if (!$this->isOnModeration()) {
            throw new \DomainException('Advert is not sent to moderation.');
        }
        $this->update([
            'status' => self::STATUS_MODERATED,
        ]);
    }

    public function reject($reason): void
    {
        $this->update([
            'status' => self::STATUS_DRAFT,
            'reject_reason' => $reason,
        ]);
    }

    public function order(int $cost): void
    {
        if (!$this->isModerated()) {
            throw new \DomainException('Advert is not moderated.');
        }
        $this->update([
            'cost' => $cost,
            'status' => self::STATUS_ORDERED,
        ]);
    }

    public function pay(Carbon $date): void
    {
        if (!$this->isOrdered()) {
            throw new \DomainException('Advert is not ordered.');
        }
        $this->update([
            'published_at' => $date,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public function getWidth(): string
    {
        return explode('x', $this->format)[0];
    }

    public function getHeight(): string
    {
        return explode('x', $this->format)[1];
    }

    public function canBeChanged(): bool
    {
        return $this->isDraft();
    }

    public function canBeRemoved(): bool
    {
        return $this->isDraft();
    }

    public function isDraft(): bool
    {
        return $this->status === self::STATUS_DRAFT;
    }

    public function isOnModeration(): bool
    {
        return $this->status === self::STATUS_MODERATION;
    }

    public function isModerated(): bool
    {
        return $this->status === self::STATUS_MODERATED;
    }

    public function isOrdered(): bool
    {
        return $this->status === self::STATUS_ORDERED;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isClosed(): bool
    {
        return $this->status === self::STATUS_CLOSED;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeForUser(Builder $query, User $user)
    {
        return $query->where('user_id', $user->id);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    private function assertIsActive(): void
    {
        if (!$this->isActive()) {
            throw new \DomainException('Banner is not active.');
        }
    }
}
