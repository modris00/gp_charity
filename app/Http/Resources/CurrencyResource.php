<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return  [
            'id' => $this->id,
            'name' => $this->name,
            'abbreviation' => $this->abbreviation,
            'campaigns_count' => count($this->campaigns),
            "bills_count" => count($this->bills),
            'created_at' => date_format($this->created_at, 'Y-m-d H:i:s'),
        ];
    }
}
