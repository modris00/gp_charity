<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FaqResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "questions" => $this->question,
            "answers" => $this->answer,
            "question_type" => $this->question_type,
            'created_at' => date_format($this->created_at, 'Y-m-d H:i:s'),
        ];
    }
}
