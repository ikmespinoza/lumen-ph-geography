<?php

namespace App\Models;

class Province extends Model {

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'region_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Get all of the cities for the Province
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    /**
     * Get the region that owns the Province
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

}
