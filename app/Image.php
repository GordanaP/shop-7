<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['path', 'is_main'];

    /**
     * The product represented by the images.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
