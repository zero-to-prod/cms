<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Routing\Route;

/**
 * @property mixed user_id
 * @property bool|mixed login
 * @property mixed logout
 * @property mixed created_at
 * @property mixed updated_at
 * @property mixed|string|null ip_address
 * @property mixed|string url
 * @property mixed|string full_url
 * @property mixed|string full_url_with_query
 * @property mixed|string path
 * @property bool|mixed secure
 * @property mixed|string|null user_agent
 * @property Route|mixed|object|string|null route
 * @property mixed|string fingerprint
 * @property mixed|string|null mac_address
 * @method static where(string $string, \Illuminate\Database\Eloquent\Collection|Model $auth_log)
 */
class AuthLog extends Model
{
    use Cachable;

    protected $table = 'auth_log';
    protected $fillable = ['*'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
