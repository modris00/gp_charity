<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    public function bills()
    {
        return $this->hasMany(Bill::class, 'supplier_id', 'id');
    }

    //Appended Model Attribute
    public function fullMobile(): Attribute
    {
        return new Attribute(get: fn () => !is_null($this->phone) ? "+" . $this->phone : "N/A");
    }

    protected $fillable = [
        'name',
        'phone',
        'address',
    ];
}
