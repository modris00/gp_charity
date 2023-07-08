<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Beneficiary extends Authenticatable
{
    use HasFactory, SoftDeletes, HasRoles;

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
