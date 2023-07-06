<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignsServices extends Model
{
    use HasFactory, SoftDeletes;

    public function bills()
    {
        return $this->hasMany(Bill::class, 'campaign_service_id', 'id');
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
