<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        $data = [
            'id' => $this->id,
            'message' => $this->message,
            'email' => $this->email,
            'phone' => $this->phone,
            'actor_id' => $this->actor_id,
            'actor_type' => $this->actor_type,
            'created_at' => date_format($this->created_at, 'Y-m-d H:i:s'),
        ];

        // if (!is_null($this->actor)) {
        //     $data['actor_id'] = $this->actor->id;
        //     $data['actor_type'] = $this->actor->type;
        // } else {
        //     $data['actor'] = $this->actor; //null for sure
        // }

        return $data;
    }
}
