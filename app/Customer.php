<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'street_address', 'postal_code', 'city', 'country', 'email',
        'phone', 'user_id'
    ];
}
