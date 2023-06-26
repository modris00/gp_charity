<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory, SoftDeletes, HasRoles;

    public function campaigns()
    {
        return $this->hasMany(Campaign::class, 'admin_id', 'id');
    }
    // Model Admin
    public function operations()
    {
        return $this->hasMany(CampaignOperations::class, "admin_id", "id");
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
    ];
}
