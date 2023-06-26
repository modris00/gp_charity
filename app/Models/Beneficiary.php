<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Beneficiary extends Model
{
    use HasFactory, SoftDeletes;

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function contactRequests()
    {
        return $this->morphMany(ContactRequest::class, "actor", "actor_type", "actor_id", "id");
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class, CampaignsServices::class, 'beneficiary_id', 'campaign_id');
    }
}
