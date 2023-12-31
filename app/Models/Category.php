<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }


    protected $fillable = [
        'name',
        'description',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
