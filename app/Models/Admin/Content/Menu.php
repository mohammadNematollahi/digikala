<?php

namespace App\Models\Admin\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ["name" , "url" ,"status" , "parent_id"];

    public function parent_menu()
    {
        return $this->belongsTo(Menu::class , "parent_id" , "id");
    }

    public function childs()
    {
        return $this->hasMany(Menu::class , "parent_id" , "id");
    }
}
