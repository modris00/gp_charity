<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'subCategories_count' => count($this->subCategories),
            'created_at' => $this->created_at ? date_format($this->created_at, 'Y-m-d H:i:s') : null,
            'deleted_at' => $this->deleted_at ? date_format($this->deleted_at, 'Y-m-d H:i:s') : null,
        ];
    }
}
