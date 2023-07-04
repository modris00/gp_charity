<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use HasFactory, SoftDeletes;

    public function campaigns()
    {
        return $this->hasMany(Currency::class, 'currency_id', 'id');
    }

    public function bills()
    {
        return $this->hasMany(Bill::class, 'currency_id', 'id');
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
