<?php

namespace App\Models\Admin\Content;

use App\Models\Admin\Market\Product;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostCategory extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $table = "post_categories";
    protected $fillable = ["name", "description", "image", "slug", "status", "tags"];

    public function products()
    {
        return $this->hasMany(Product::class , "category_id");
    }
}
