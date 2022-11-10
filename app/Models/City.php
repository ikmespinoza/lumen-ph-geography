<?php

namespace App\Models;

class City extends Model {

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

    /**
     * Get the city's formatted is_capital.
     *
     * @param  boolean  $value
     * @return string
     */
    public function getIsCapitalAttribute($value) {
        return $value ? true : false;
    }

    /**
     * Get the classification of the City
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }

    /**
     * Get the province that owns the City
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

}
