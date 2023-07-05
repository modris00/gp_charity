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
        // return [
        //     'id' => $this->id,
        //     'name' => $this->name,
        //     'created_at' => date_format($this->created_at, 'Y-m-d H:i:s'),

        //     'country' => $this->country,
        //     'country_name' => $this->country->name ?? '',

        //     'areas_count' => count($this->areas),
        //     'areas' => $this->areas,
        // ];

        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at ? date_format($this->created_at, 'Y-m-d H:i:s') : null,
            'deleted_at' => $this->deleted_at ? date_format($this->deleted_at, 'Y-m-d H:i:s') : null,
            'areas_count' => count($this->areas),
        ];

        if (!is_null($this->country)) {
            $data['country_id'] = $this->country->id;
            $data['country_name'] = $this->country->name;
        } else {
            $data['country'] = $this->country; //null for sure
        }

        return $data;
    }
}
