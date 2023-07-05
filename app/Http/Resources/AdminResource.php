<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'created_at' => date_format($this->created_at, 'Y-m-d H:i:s'),

            "campaigns_count" => count($this->campaigns),
            "operations_count" => count($this->operations),
        ];
    }
}
