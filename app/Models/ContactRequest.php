<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "title", "message", "email", "phone", "actor_id", "actor_type",
    ];

    public function actor()
    {
        return $this->morphTo("actor");
    }
}
