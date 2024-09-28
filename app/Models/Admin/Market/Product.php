<?php

namespace App\Models\Admin\Market;

use App\Models\CartItem;
use App\Models\User;
use App\Models\Admin\Comment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
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

    public function comments()
    {
        return $this->morphMany(Comment::class , "commentable");
    }

    public function productMeta()
    {
        return $this->hasMany(ProductMeta::class , "product_id" , "id");
    }

    public function productColor()
    {
        return $this->hasMany(ProductColor::class , "product_id" , "id");
    }

    public function productGallery()
    {
        return $this->hasMany(ProductGallery::class , "product_id" , "id");
    }

    public function warranties()
    {
        return $this->hasMany(Warranty::class , "product_id" , "id");
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class , "category_id" , "id");
    }

    public function amazingSales()
    {
        return $this->hasMany(AmazingSale::class , "product_id" , "id");
    }

    public function amazingSale()
    {
        return $this->amazingSales()->where(function($query){
            $query->where("start_date" , "<" , Carbon::now())->where("end_date" , ">=" , Carbon::now())->where("status" , 1);
        });
    }

    public function showColores()
    {
        return $this->productColor()->where("status" , 1);
    }

    public function activeComments()
    {
        return $this->comments()->where("approved" , 1)->whereNull("parent_id");
    }


    public function favorites()
    {
        return $this->belongsToMany(User::class , "product_user" ,"product_id" , "user_id");
    }

    public function carts()
    {
        return $this->hasMany(CartItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = ["name" , "slug" , "status" ,"introduction" ,"image" ,"weight" ,"length" ,"width" , "height" ,"price" ,"marketable" ,"tags" ,"sold_number" , "frozen_number" ,"marketable_number" ,"brand_id" ,"category_id" , "published_at"];
}
