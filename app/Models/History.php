<?php

namespace App\Models;

class History extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'modified_at' => 'datetime:Y-m-d',
    ];
}
