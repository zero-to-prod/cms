<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $fillable = ['*'];

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
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}