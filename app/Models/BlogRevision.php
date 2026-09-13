<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogRevision extends Model
{
    protected $fillable = [
        'blog_id',
        'user_id',
        'title',
        'content',
        'excerpt',
        'meta_title',
        'meta_description',
        'revision_notes',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
