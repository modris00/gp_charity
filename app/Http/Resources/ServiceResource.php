<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'description' => $this->description,
            'active' => $this->active,
            'image' => $this->image,

            "operations_count" => count($this->operations),
            // "campaigns_count" => count($this->campaigns),
        ];

        if (is_null($this->subCategory)) {
            $data['sub_category'] = $this->subCategory; //null

        } else {
            $data['sub_category_name'] = $this->subCategory->name;
            $data['sub_category_id'] = $this->subCategory->id;
        }

        return $data;
    }
}
