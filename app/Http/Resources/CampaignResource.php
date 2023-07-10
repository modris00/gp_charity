<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
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
        //     'title' => $this->title,
        //     'amount' => $this->amount,
        //     'status' => $this->status,
        //     'start_date' => $this->start_date,
        //     'end_date' => $this->end_date,
        //     'admin' => $this->admin,
        //     'currency' => $this->currency,
        // ];

        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'amount' => $this->amount,
            'status' => $this->status,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,

            "bills_count" => $this->bills_count,
            "operations_count" => $this->operations->count(),
            // "services_count" => $this->services_count,
            'services_count' => $this->services->count(),
            // "name_services" => $this->services->pluck('name')->toArray(),

            // "active_services" => $this->services->pluck('active')->toArray(),
            // "subCatgory_campaign" => $this->services->pluck("subCategory.name")->toArray(),
            // 'category_name' => $this->services->pluck('subCategory.category.name')->toArray(),

            //many to many :
            // "services_count" => count($this->services),
            // "donors_count" => count($this->donors),
            // "beneficiaries_count" => count($this->beneficiaries),
        ];

        if (!is_null($this->admin)) {
            $data['admin_id'] = $this->admin->id;
            $data['admin_name'] = $this->admin->username;
        } else {
            $data['admin'] = $this->admin; //null for sure
        }

        if (!is_null($this->currency)) {
            $data['currency_id'] = $this->currency->id;
            $data['currency_name'] = $this->currency->name;
        } else {
            $data['currency'] = $this->currency; //null for sure
        }

        return $data;
    }
}
