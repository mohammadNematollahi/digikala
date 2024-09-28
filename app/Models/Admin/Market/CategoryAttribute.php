<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryAttribute extends Model
{
    use HasFactory , SoftDeletes;

    public function category()
    {
        return $this->belongsTo(ProductCategory::class , "category_id" , "id");
    }

    public function values()
    {
        return $this->hasMany(CategoryValue::class , "category_attribute_id" , "id");
    }

    protected $fillable = ["name" , "unit" , "category_id" ];
} 
