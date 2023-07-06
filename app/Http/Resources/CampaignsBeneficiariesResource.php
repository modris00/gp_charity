<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignsBeneficiariesResource extends JsonResource
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
        //     'status' => $this->status,
        //     'campaign_id' => $this->campaign_id,
        //     'beneficiary_id' => $this->beneficiary_id,
        // ];

        $data = [
            'id' => $this->id,
            'amount' => $this->amount,
            'description' => $this->description,
            'status' => $this->status,
            // 'campaign_id' => $this->campaign_id,
            // 'beneficiary_id' => $this->beneficiary_id,
        ];

        if (!is_null($this->campaign)) {
            $data['campaign_id'] = $this->campaign->id;
            $data['campaign_title'] = $this->campaign->title;
        } else {
            $data['campaign'] = $this->campaign; //null for sure
        }

        if (!is_null($this->beneficiary)) {
            $data['beneficiary_id'] = $this->beneficiary->id;
            $data['beneficiary_name'] = $this->beneficiary->name;
        } else {
            $data['beneficiary'] = $this->beneficiary; //null for sure
        }

        return $data;
    }
}
