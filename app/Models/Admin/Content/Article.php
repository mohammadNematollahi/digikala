<?php

namespace App\Models\Admin\Content;

use App\Models\Admin\Comment;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory , SoftDeletes , Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    
    protected $table = "posts";
    protected $fillable  = ["title" , "body" , "summary" , "commentable" , "published_at" , "image" , "slug" , "status" , "tags" , "author_id" , "category_id"];

    public function category()
    {
        return $this->belongsTo(PostCategory::class , "category_id" , "id");
    }

    public function comments()
    {
        return $this->morphMany(Comment::class , "commentable");
    }
}
