<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use SoftDeletes,HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'type',
        'content',
        'user_id',        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}