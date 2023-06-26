<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "cost" => $this->cost,
            "description" => $this->description,
            "campaign_id" => $this->campaign_id,
            "supplier_id" => $this->supplier_id,
            "currency_id" => $this->currency_id,
            "campaign_service_id" => $this->campaign_service_id,
        ];
    }
}
