<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            if (empty($model->slug)) {
                $nameOrSku = $model->model_name ? $model->model_name . '-' . $model->sku_code : $model->sku_code;
                $model->slug = \Illuminate\Support\Str::slug($nameOrSku);
            } else {
                $model->slug = \Illuminate\Support\Str::slug($model->slug);
            }
        });
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order', 'asc');
    }

    public function getVideoEmbedUrl()
    {
        if (!$this->video_url) {
            return null;
        }

        $url = $this->video_url;

        // YouTube regex
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $url, $match)) {
            return "https://www.youtube.com/embed/" . $match[1];
        }

        // Vimeo regex
        if (preg_match('/vimeo\.com\/(?:video\/)?([0-9]+)/i', $url, $match)) {
            return "https://player.vimeo.com/video/" . $match[1];
        }

        // Return raw URL for custom direct links
        return $url;
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->where('is_approved', true)->latest();
    }

    public function allReviews()
    {
        return $this->hasMany(Review::class)->latest();
    }

    public function getAverageRatingAttribute()
    {
        return round($this->reviews()->avg('rating') ?? 0, 1);
    }

    public function getReviewCountAttribute()
    {
        return $this->reviews()->count();
    }
}
