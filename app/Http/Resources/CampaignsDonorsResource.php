<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignsDonorsResource extends JsonResource
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
        // ];

        $data = [
            'id' => $this->id,
            'amount' => $this->amount,
        ];

        if (!is_null($this->campaign)) {
            $data['campaign_id'] = $this->campaign->id;
            $data['campaign_title'] = $this->campaign->title;
        } else {
            $data['campaign'] = $this->campaign; //null for sure
        }

        if (!is_null($this->donor)) {
            $data['donor_id'] = $this->donor->id;
            $data['donor_name'] = $this->donor->name;
        } else {
            $data['donor'] = $this->donor; //null for sure
        }

        return $data;
    }
}
