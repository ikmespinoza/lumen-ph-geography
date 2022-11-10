<?php

namespace App\Models;

class Region extends Model {

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    /**
     * Get all of the provinces for the Region
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function provinces()
    {
        return $this->hasMany(Province::class);
    }

}
