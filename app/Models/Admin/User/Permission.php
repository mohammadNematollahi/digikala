<?php

namespace App\Models\Admin\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ["name" , "description" , "status"];

    public function roles()
    {
        return $this->belongsToMany(Role::class , "permission_role" , "permission_id" , "role_id");
    }
}
