<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    protected $fillable = ['name', 'description'];

    /**
     * @return HasOne
     */
    public function product_type(): HasOne
    {
        return $this->hasOne(ProductType::class);
    }
}
