<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'code', 'slug', 'description', 'meta_title', 'meta_description', 'banner_url', 'home_image_url', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            if (empty($model->slug)) {
                $model->slug = \Illuminate\Support\Str::slug($model->name);
            } else {
                $model->slug = \Illuminate\Support\Str::slug($model->slug);
            }
        });
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}
