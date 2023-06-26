<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donor extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'donors';

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
        return $this->belongsToMany(Campaign::class, CampaignsServices::class, 'donor_id', 'campaign_id');
    }
}
