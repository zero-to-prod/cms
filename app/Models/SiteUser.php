<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class SiteUser extends Model
{

    use Cachable;

    protected $table    = 'site_user';
    protected $fillable = ['*'];
}
