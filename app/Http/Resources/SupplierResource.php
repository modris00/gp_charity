<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "phone" => $this->phone,
            "address" => $this->address,
            // "created_at" => Carbon::parse($this->created_at)->diffForHumans(),
            'created_at' => date_format($this->created_at, 'Y-m-d H:i:s'),

            "bills_count" => count($this->bills),
        ];
    }
}
