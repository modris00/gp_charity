<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignOperationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return[
            "date"=> $this->date,
            "description"=> $this->description,
            "cost"=> $this->cost,
            "cost_type"=> $this->cost_type,
            "admin_id"=> $this->admin_id,
            "campaign_id"=> $this->campaign_id,
            "service_id"=> $this->service_id,
        ];
    }
}
