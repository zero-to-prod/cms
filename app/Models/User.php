<?php

namespace App\Models;

use App\Cache\User\CacheUser;
use App\Cache\User\CacheUserAdmin;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * @method static create(array $array)
 * @method static where(string $string, $username)
 * @method static latest()
 * @property mixed name
 * @property mixed email
 * @property mixed|string password
 * @property mixed id
 * @property mixed email_verified_at
 * @property mixed remember_token
 * @property mixed created_at
 * @property mixed updated_at
 * @property mixed deleted_at
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasApiTokens;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['*'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden
        = [
            'password', 'remember_token',
        ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts
        = [
            'email_verified_at' => 'datetime',
        ];

    /**
     * @return BelongsTo
     */
    public function meta(): BelongsTo
    {
        return $this->belongsTo(Meta::class);
    }

    /**
     * @return BelongsToMany
     */
    public function site(): BelongsToMany
    {
        return $this->belongsToMany(Site::class);
    }

    /**
     * @return BelongsTo
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    /**
     * @return HasOne
     */
    public function auth_log(): HasOne
    {
        return $this->hasOne(AuthLog::class);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(static function ($user) {
            $meta = Meta::create(['user_id' => CacheUserAdmin::get()->id]);
            $user->meta_id = $meta->id;
            $contact = Contact::create(['user_id' => $user->id]);
            $user->contact_id = $contact->id;
        });
        self::created(static function () {
            CacheUser::forget();
        });

        self::updated(static function () {
            CacheUser::forget();
        });

        self::deleted(static function () {
            CacheUser::forget();
        });
    }
}
