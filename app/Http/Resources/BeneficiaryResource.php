<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BeneficiaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'age' => $this->age,
            'gender' => $this->gender,
            // 'area_id' => $this->area->name
        ];

        if (!is_null($this->area)) {
            $data['area_id'] = $this->area->id;
            $data['area_name'] = $this->area->name;
        } else {
            $data['area'] = $this->area; //null for sure
        }

        return $data;

        // return [
        //     'id' => $this->id,
        //     'name' => $this->name,
        //     'username' => $this->username,
        //     'email' => $this->email,
        //     'age' => $this->age,
        //     'gender' => $this->gender,
        //     'area_id' => $this->area->name
        // ];
    }
}
