<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\Models\RequestLogTest;

/**
 * @property int|mixed user_id
 * @property mixed|string path
 * @property mixed request_response_time_delta
 * @property mixed error_message
 * @property int|mixed error
 * @method static where(string $string, \Illuminate\Support\HigherOrderCollectionProxy $id)
 */
class RequestLog extends Model
{
    use Cachable;

    protected $table    = 'request_log';
    protected $fillable = ['*'];
    protected $casts    = ['error' => 'boolean'];

    /**
     * @return BelongsTo
     * @see RequestLogTest::user()
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
