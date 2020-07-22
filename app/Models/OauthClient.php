<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, int $int)
 */
class OauthClient extends Model
{
    use Cachable;

    protected $fillable = ['*'];
}
