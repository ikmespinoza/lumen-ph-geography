<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegionResource extends JsonResource
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
            'name_tl' => $this->name_tl,
            'acronym' => $this->acronym,
            'provinces' => $this->provinces,
        );
    }
}
