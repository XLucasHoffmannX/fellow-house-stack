<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;

    protected $table = 'likes';

    protected $fillable = [
        'post_id',
        'user_reference',
        'type',     
        'ativ'   
    ]; 

    public function posts(){
        return $this->belongsTo(Posts::class);
    }
}
