<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory, SoftDeletes;

    public function city()
    {

        return $this->belongsTo(City::class);
    }

    public function donors()
    {

        return $this->hasMany(Donor::class, 'area_id', 'id');
    }


    public function beneficiaries()
    {

        return $this->hasMany(Beneficiary::class,  'area_id', 'id');
    }
}
