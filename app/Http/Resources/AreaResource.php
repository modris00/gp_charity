<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AreaResource extends JsonResource
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
        //     'city_name' => $this->city->name,
        //     'city' => $this->city,
        // ];

        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => date_format($this->created_at, 'Y-m-d H:i:s'),
            // 'city' => $this->city,
            "donors_count" => count($this->donors),
            "beneficiaries_count" => count($this->beneficiaries),
        ];

        if (!is_null($this->category)) {
            $data['city_id'] = $this->city->id;
            $data['city_name'] = $this->city->name;
        } else {
            $data['city'] = $this->city; //null for sure
        }

        return $data;
    }
}
