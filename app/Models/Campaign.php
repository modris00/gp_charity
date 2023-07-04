<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use HasFactory, SoftDeletes;

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function operations()
    {
        return $this->hasMany(CampaignOperations::class, 'campaign_id', 'id');
    }

    public function campaignImages()
    {
        return $this->hasMany(CampaignImages::class, 'campaign_id', 'id');
    }

    public function bills()
    {
        return $this->hasMany(Bill::class, 'campaign_id', 'id');
    }

    //Many-To-Many Relationships
    public function services()
    {
        return $this->belongsToMany(Service::class, CampaignsServices::class,  'campaign_id', 'service_id');
    }

    public function donors()
    {
        return $this->belongsToMany(Donor::class, CampaignsDonors::class,  'campaign_id', 'donor_id');
    }

    public function beneficiaries()
    {
        return $this->belongsToMany(beneficiary::class, CampaignsBeneficiaries::class,  'campaign_id', 'beneficiary_id');
    }




    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
