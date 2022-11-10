<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProvinceResource extends JsonResource
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
            'code' => $this->code,
            'name' => $this->name,
            'alt_name' => $this->alt_name,
            'name_tl' => $this->name_tl,
            'region' => $this->region,
            'cities' => $this->cities,
        );
    }
}
