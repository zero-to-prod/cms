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
    protected $table    = 'meta';
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
    public function product(): HasOne
    {
        return $this->hasOne(Product::class);
    }

    /**
     * @return HasOne
     */
    public function product_type(): HasOne
    {
        return $this->hasOne(ProductType::class);
    }

    /**
     * @return HasOne
     */
    public function contact(): HasOne
    {
        return $this->hasOne(Contact::class);
    }

    /**
     * @return HasOne
     */
    public function status(): HasOne
    {
        return $this->hasOne(Status::class);
    }
}
