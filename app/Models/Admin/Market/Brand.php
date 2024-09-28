<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Admin\Market\ProductCategory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory , SoftDeletes , Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'original_name'
            ]
        ];
    }
    
    protected $fillable  = ["persian_name"  ,  "original_name" , "logo" , "slug" , "status" , "tags"];
}
