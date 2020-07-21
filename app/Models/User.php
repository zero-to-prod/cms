<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Tests\Feature\Models\UserTest;

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
     * @see UserTest::meta()
     * @return BelongsTo
     */
    public function meta(): BelongsTo
    {
        return $this->belongsTo(Meta::class);
    }

    /**
     * @return BelongsTo
     * @see UserTest::contact()
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    /**
     * @return HasOne
     * @see UserTest::auth_log()
     */
    public function auth_log(): HasOne
    {
        return $this->hasOne(AuthLog::class);
    }

    /**
     * @return HasOne
     * @see UserTest::request_log()
     */
    public function request_log(): HasOne
    {
        return $this->hasOne(RequestLog::class);
    }

    /**
     * Boots the model.
     */
    public static function boot(): void
    {
        parent::boot();
        self::creating(static function ($user) {
            $meta             = Meta::create(['user_id' => self::where('email', config('admin.email'))->first()]);
            $user->meta_id    = $meta->id;
            $contact = Contact::create(['user_id' => $user->id]);
            $user->contact_id = $contact->id;
        });
    }
}
