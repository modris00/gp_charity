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

        $data = [
            "cost" => $this->cost,
            "description" => $this->description,
            'created_at' => date_format($this->created_at, 'Y-m-d H:i:s'),
        ];

        if (!is_null($this->campaign)) {
            $data['campaign_id'] = $this->campaign->id;
            $data['campaign_title'] = $this->campaign->title;
        } else {
            $data['campaign'] = $this->campaign; //null for sure
        }

        if (!is_null($this->supplier)) {
            $data['supplier_id'] = $this->supplier->id;
            $data['supplier_name'] = $this->supplier->name;
        } else {
            $data['supplier'] = $this->supplier; //null for sure
        }

        if (!is_null($this->currency)) {
            $data['currency_id'] = $this->currency->id;
            $data['currency_name'] = $this->currency->name;
        } else {
            $data['currency'] = $this->currency; //null for sure
        }

        if (!is_null($this->campaignService)) {
            $data['campaignService'] = $this->campaignService->id;
        } else {
            $data['campaignService'] = $this->campaignService; //null for sure
        }

        return $data;

        // return [
        //     "cost" => $this->cost,
        //     "description" => $this->description,
        //     "campaign_id" => $this->campaign_id,
        //     "supplier_id" => $this->supplier_id,
        //     "currency_id" => $this->currency_id,
        //     "campaign_service_id" => $this->campaign_service_id,
        // ];
    }
}
