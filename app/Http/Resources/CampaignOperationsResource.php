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
        // return[
        //     "date"=> $this->date,
        //     "description"=> $this->description,
        //     "cost"=> $this->cost,
        //     "cost_type"=> $this->cost_type,
        //     "admin_id"=> $this->admin_id,
        //     "campaign_id"=> $this->campaign_id,
        //     "service_id"=> $this->service_id,
        // ];

        $data = [
            "id" => $this->id,
            "date" => $this->date,
            "description" => $this->description,
            "cost" => $this->cost,
            "cost_type" => $this->cost_type,
            // "admin_id"=> $this->admin_id,
            // "campaign_id"=> $this->campaign_id,
            // "service_id"=> $this->service_id,
            'created_at' => $this->created_at ? date_format($this->created_at, 'Y-m-d H:i:s') : null,
            'deleted_at' => $this->deleted_at ? date_format($this->deleted_at, 'Y-m-d H:i:s') : null,

        ];

        if (!is_null($this->admin)) {
            $data['admin_id'] = $this->admin->id;
            $data['admin_name'] = $this->admin->name;
        } else {
            $data['admin'] = $this->admin; //null for sure
        }

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
