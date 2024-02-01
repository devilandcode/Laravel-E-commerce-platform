<?php

namespace App\Models\User;

//use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Adverts\Advert\Advert;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User\Network;
use Laravel\Passport\HasApiTokens;
use Laravel\Socialite\Contracts\User as NetworkUser;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $role
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $status
 * @property string|null $verify_token
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVerifyToken($value)
 * @property string|null $phone
 * @property bool $phone_verified
 * @property string|null $phone_verify_token
 * @property \Illuminate\Support\Carbon|null $phone_verify_token_expire
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneVerifyToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneVerifyTokenExpire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @property string|null $last_name
 * @property bool $phone_auth
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneAuth($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Advert> $favorites
 * @property-read int|null $favorites_count
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const STATUS_WAIT = 'Waiting';
    public const STATUS_ACTIVE = 'Active';
    public const ROLE_USER = 'User';
    public const ROLE_MODERATOR = 'Moderator';
    public const ROLE_ADMIN = 'Admin';

    protected $fillable = [
        'name', 'last_name', 'phone', 'email', 'password', 'verify_token', 'status', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'phone_verified' => 'boolean',
        'phone_verify_token_expire' => 'datetime',
        'phone_auth' => 'boolean',
    ];

    public static function rolesList(): array
    {
        return [
            self::ROLE_USER => 'User',
            self::ROLE_MODERATOR => 'Moderator',
            self::ROLE_ADMIN => 'Admin',
        ];
    }

    public static function register(string $name, string $email, string $password): self
    {
        return static::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'verify_token' => Str::uuid(),
            'status' => self::STATUS_WAIT,
        ]);
    }

    public static function registerByNetwork(string $network, NetworkUser $data): self
    {
        $user = static::create([
            'name' => $data->getId(),
            'email' => $data->getEmail(),
            'password' => null,
            'verify_token' => null,
            'role' => self::ROLE_USER,
            'status' => self::STATUS_ACTIVE,
        ]);
        $user->networks()->create([
            'network' => $network,
            'identity' => $data->getId(),

        ]);
        return $user;
    }

    public static function new($name, $email): self
    {
        return static::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::Make(Str::random()),
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function verify(): void
    {
        if (!$this->isWait()) {
            throw new \DomainException('User is already verified.');
        }

        $this->update([
            'status' => self::STATUS_ACTIVE,
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'verify_token' => null,
        ]);
    }

    public function changeRole($role): void
    {
        if (!in_array($role, [self::ROLE_USER, self::ROLE_ADMIN], true)) {
            throw new \InvalidArgumentException('Undefined role "' . $role . '"');
        }
        if ($this->role === $role) {
            throw new \DomainException('Role is already assigned.');
        }
        $this->update(['role' => $role]);
    }

    public function unverifyPhone(): void
    {
        $this->phone_verified = false;
        $this->phone_verify_token = null;
        $this->phone_verify_token_expire = null;
        $this->phone_auth = false;
        $this->saveOrFail();
    }

    public function requestPhoneVerification(Carbon $now): string
    {
        if (empty($this->phone)) {
            throw new \DomainException('Phone number is empty.');
        }
        if (!empty($this->phone_verify_token) && $this->phone_verify_token_expire && $this->phone_verify_token_expire->gt($now)) {
            throw new \DomainException('Token is already requested.');
        }
        $this->phone_verified = false;
        $this->phone_verify_token = (string)random_int(10000, 99999);
        $this->phone_verify_token_expire = $now->copy()->addSeconds(300);
        $this->saveOrFail();

        return $this->phone_verify_token;
    }

    public function verifyPhone($token, Carbon $now): void
    {
        if ($token !== $this->phone_verify_token) {
            throw new \DomainException('Incorrect verify token.');
        }
        if ($this->phone_verify_token_expire->lt($now)) {
            throw new \DomainException('Token is expired.');
        }

        $this->phone_verified = true;
        $this->phone_verify_token = null;
        $this->phone_verify_token_expire = null;
        $this->saveOrFail();
    }

    public function enablePhoneAuth(): void
    {
        if (empty($this->phone) && !$this->isPhoneVerified()) {
            throw new \DomainException('Phone number is empty.');
        }
        $this->phone_auth = true;
        $this->saveOrFail();
    }

    public function disablePhoneAuth(): void
    {
        if (empty($this->phone) && !$this->isPhoneVerified()) {
            throw new \DomainException('Phone number is empty.');
        }
        $this->phone_auth = false;
        $this->saveOrFail();
    }

    public function hasFilledProfile(): bool
    {
        return !empty($this->name) || !empty($this->last_name) || $this->isPhoneVerified();
    }

    public function isPhoneAuthEnabled(): bool
    {
        return (bool)$this->phone_auth;
    }

    public function isModerator(): bool
    {
        return $this->role === self::ROLE_MODERATOR;
    }

    public function isAdmin(): bool
    {
        return $this->role === User::ROLE_ADMIN;
    }

    public function isPhoneVerified(): bool
    {
        return $this->phone_verified;
    }

    public function favorites()
    {
        return $this->belongsToMany(Advert::class, 'advert_favorites', 'user_id', 'advert_id');
    }

    public function hasInFavorites($id): bool
    {
        return $this->favorites()->where('id', $id)->exists();
    }

    public function addToFavorites($id): void
    {
        if ($this->hasInFavorites($id)) {
            throw new \DomainException('This advert is already added to favorites.');
        }
        $this->favorites()->attach($id);
    }

    public function removeFromFavorites($id): void
    {
        $this->favorites()->detach($id);
    }

    public function networks()
    {
        return $this->hasMany(Network::class, 'user_id', 'id');
    }

    public function scopeByNetwork(Builder $query, string $network, string $identity): Builder
    {
        return $query->whereHas('networks', function(Builder $query) use ($network, $identity) {
            $query->where('network', $network)->where('identity', $identity);
        });
    }

    public function findForPassport($identifier)
    {
        return self::where('email', $identifier)->where('status', self::STATUS_ACTIVE)->first();
    }
}
