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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'active' => $this->active,
            'image' => $this->image,
            'sub_category_name' => $this->subcategories->name,
            'sub_category' => $this->subcategory,
            "operations_count" => count($this->operations),
            // "campaigns_count" => count($this->campaigns),
        ];
    }
}
