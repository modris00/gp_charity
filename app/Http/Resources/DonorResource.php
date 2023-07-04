<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DonorResource extends JsonResource
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
        //     'username' => $this->username,
        //     'email' => $this->email,
        //     'phone' => $this->phone,
        //     'area_name' => $this->area->name,
        //     'area' => $this->area,
        //     // 'campaigns_count' => count($this->campaigns),
        //     // 'contact_requests_count' => count($this->ContactRequests),
        // ];

        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'phone' => $this->phone,
            // 'campaigns_count' => count($this->campaigns),
            // 'contact_requests_count' => count($this->ContactRequests),
        ];

        if (!is_null($this->area)) {
            $data['area_id'] = $this->area->id;
            $data['area_name'] = $this->area->name;
        } else {
            $data['area'] = $this->area; //null for sure
        }

        return $data;
    }
}
