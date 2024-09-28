<?php

namespace App\Models\Admin\Notify;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailFile extends Model
{
    use HasFactory , SoftDeletes;

    protected $table = "public_email_files";
    protected $fillable  = ["public_email_id" , "file_path" , "status" , "file_size" , "file_type"];

    public function email()
    {
        return $this->belongsTo(Email::class , "public_email_id" ,"id");
    }
}
