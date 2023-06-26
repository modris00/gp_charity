<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryResource extends JsonResource
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
        //     'description' => $this->description,
        //     'category' => $this->category,
        //     'category_id' => $this->category->id ?? null,
        //     'category_name' => $this->category->name ?? null,
        // ];

        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            // 'category' => $this->category,
        ];

        if (!is_null($this->category)) {
            $data['category_id'] = $this->category->id;
            $data['category_name'] = $this->category->name;
        } else {
            $data['category'] = $this->category; //null for sure
        }

        return $data;
    }
}
