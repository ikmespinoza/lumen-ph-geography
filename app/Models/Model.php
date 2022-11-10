<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent {

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'province_id',
        'classification_id',
        'created_at',
        'updated_at',
    ];

}
