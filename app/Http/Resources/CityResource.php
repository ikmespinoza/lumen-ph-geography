<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array( 
            'name' => $this->name,
            'alt_name' => $this->alt_name,
            'full_name' => $this->full_name,
            'is_capital' => $this->is_capital,
            'province' => $this->provinces,
            'classification' => $this->classification,
        );
    }
}
