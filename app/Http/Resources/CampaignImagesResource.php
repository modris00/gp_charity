<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignImagesResource extends JsonResource
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
        //     'description' => $this->description,
        //     'active' => $this->active,
        //     'image' => $this->image,
        //     'campaign' => $this->campaign
        // ];

        $data = [
            'id' => $this->id,
            'description' => $this->description,
            'active' => $this->active,
            'image' => $this->image,
            // 'campaign' => $this->campaign
        ];

        if (!is_null($this->campaign)) {
            $data['campaign_id'] = $this->campaign->id;
            $data['campaign_title'] = $this->campaign->title;
        } else {
            $data['campaign'] = $this->campaign; //null for sure
        }

        return $data;
    }
}
