<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    use HasFactory , SoftDeletes , Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    public function parentMenu()
    {
        return $this->belongsTo(ProductCategory::class , "parent_id" , "id");
    }

    public function products()
    {
        return $this->hasMany(Product::class , "category_id" , "id");
    }

    protected $table = "product_categories";
    protected $fillable  = ["name"  ,  "description" , "image" , "slug" , "status" , "tags" , "show_in_menu" , "parent_id"];
}
