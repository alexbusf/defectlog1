<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'category_id',
        'user_id',
        'image',
    ];

    // A post belongs to a user
    public function user() {
        return $this->belongsTo(User::class);
    }

    // A post belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
