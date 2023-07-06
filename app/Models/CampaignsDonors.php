<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignsDonors extends Model
{
    use HasFactory, SoftDeletes;

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id', 'id');
    }

    public function donor()
    {
        return $this->belongsTo(Donor::class, 'donor_id', 'id');
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
