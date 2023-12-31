<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'cost',
        'description',
        'campaign_id',
        'supplier_id',
        'currency_id',
        'campaign_service_id'
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function campaignService()
    {
        return $this->belongsTo(CampaignsServices::class);
    }
}
