<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int|mixed user_id
 * @property mixed|string path
 * @property mixed request_response_time_delta
 * @property mixed error_message
 * @property int|mixed error
 */
class RequestLog extends Model
{
    use Cachable;

    protected $table = 'request_log';
    protected $fillable = ['*'];
}
