<?php

namespace App\Models\Admin\Notify;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Email extends Model
{
    use HasFactory , SoftDeletes;

    protected $table = "public_email";
    protected $fillable  = ["subject" , "body" , "status" , "published_at"];

    public function files()
    {
        return $this->hasMany(EmailFile::class , "public_email_id" , "id");
    }
}
