<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignsServicesResource extends JsonResource
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
        //     'amount' => $this->amount,
        //     'description' => $this->description,
        //     'start_date' => $this->start_date,
        //     'end_date' => $this->end_date,
        //     'status' => $this->status,
        //     'service_id' => $this->service_id,
        //     'campaign_id' => $this->campaign_id,
        // ];

        $data = [
            'id' => $this->id,
            'amount' => $this->amount,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
            // 'service_id' => $this->service_id,
            // 'campaign_id' => $this->campaign_id,
        ];

        if (!is_null($this->campaign)) {
            $data['campaign_id'] = $this->campaign->id;
            $data['campaign_title'] = $this->campaign->title;
        } else {
            $data['campaign'] = $this->campaign; //null for sure
        }

        if (!is_null($this->service)) {
            $data['service_id'] = $this->service->id;
            $data['service_name'] = $this->service->name;
        } else {
            $data['service'] = $this->service; //null for sure
        }

        return $data;
    }
}
