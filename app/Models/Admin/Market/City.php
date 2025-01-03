<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ["name" , "province_id"];

    public function province()
    {
        return $this->belongsTo(Province::class , "province_id" , "id");
    }
}
