<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignOperations extends Model
{
    use HasFactory , SoftDeletes;

    /**
     * relationship
     */
    public function admin(){
        return $this->belongsTo(Admin::class,"admin_id","id");
    }
    /**
     * relationship Campaign
     */
    public function campaign(){
        return $this->belongsTo(Campaign::class,"campaign_id","id");
    }

    public function service(){
        return $this->belongsTo(Service::class,"service_id","id");
    }
}
