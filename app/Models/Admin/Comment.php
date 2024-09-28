<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory , SoftDeletes;

    public function commentable()
    {
        return $this->morphTo();
    }
    public function user()
    {
        return $this->belongsTo(User::class , "author_id" , "id");
    }

    public function answers()
    {
        return $this->hasMany($this , "parent_id")->whereNotNull("parent_id")->where("approved" , 1);
    }

    protected $fillable  = ["body" ,"commentable_id" , "commentable_type" , "status" , "author_id" , "approved" , "parent_id"];
}
