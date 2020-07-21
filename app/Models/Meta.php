<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property mixed name
 * @property mixed id
 */
class Meta extends Model
{
    use Cachable;

    protected $fillable = ['*'];
    protected $table = 'meta';
    /**
     * @var mixed
     */
    public $user_id;
    /**
     * @var mixed
     */
    public $contact_id;
    /**
     * @var mixed
     */
    public $note;
    /**
     * @var mixed
     */
    public $link;

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    /**
     * @return HasOne
     */
    public function site(): HasOne
    {
        return $this->hasOne(Site::class);
    }
}
