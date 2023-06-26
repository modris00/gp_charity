<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => date_format($this->created_at, 'Y-m-d H:i:s'),

            'country' => $this->country,
            'country_name' => $this->country->name ?? '',

            'areas_count' => count($this->areas),
            'areas' => $this->areas,
        ];
    }
}
