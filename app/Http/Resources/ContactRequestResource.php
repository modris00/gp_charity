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
            'title' => $this->title,
            'message' => $this->message,
            'email' => $this->email,
            'phone' => $this->phone,
            'actor_id' => $this->actor_id,
            'actor_type' => $this->actor_type,
            'response' => $this->response,
            'isClosed' => $this->isClosed,
            'created_at' => date_format($this->created_at, 'Y-m-d H:i:s'),
            'updated_at' => date_format($this->updated_at, 'Y-m-d H:i:s'),
            // 'deleted_at' => date_format($this->deleted_at, 'Y-m-d H:i:s'),
        ];

        if (!is_null($this->actor)) {
            $data['actor_name'] = $this->actor->name;
        }
        //  else {
        //     $data['actor'] = $this->actor; //null for sure
        // }

        return $data;
    }
}
