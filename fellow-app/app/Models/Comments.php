<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = "comments";

    protected $fillable = [
        'post_id',
        'user_reference',
        'content',     
        'explict'  
    ];

    public function posts(){
        return $this->belongsTo(Posts::class);
    }
}
