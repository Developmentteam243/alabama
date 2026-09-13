<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'tag',
        'author_name',
        'excerpt',
        'content',
        'image_url',
        'image_alt',
        'is_active',
        'status',
        'published_at',
        'scheduled_at',
        'meta_title',
        'meta_description',
        'primary_keyword',
        'secondary_keywords',
        'og_title',
        'og_description',
        'og_image_url',
        'twitter_title',
        'twitter_description',
        'schema_markup',
        'faqs',
        'internal_external_links',
        'related_blog_ids',
        'related_product_ids',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'faqs' => 'array',
        'internal_external_links' => 'array',
        'related_blog_ids' => 'array',
        'related_product_ids' => 'array',
        'published_at' => 'datetime',
        'scheduled_at' => 'datetime',
    ];

    public function revisions()
    {
        return $this->hasMany(BlogRevision::class)->latest();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->where('status', 'published')
                  ->orWhere(function ($sub) {
                      $sub->where('status', 'scheduled')
                          ->whereNotNull('scheduled_at')
                          ->where('scheduled_at', '<=', now());
                  })
                  ->orWhereNull('status');
            });
    }

    /**
     * Get related blogs based on related_blog_ids
     */
    public function getRelatedBlogsAttribute()
    {
        if (empty($this->related_blog_ids) || !is_array($this->related_blog_ids)) {
            return collect();
        }
        return Blog::whereIn('id', $this->related_blog_ids)->active()->get();
    }

    /**
     * Get related products based on related_product_ids
     */
    public function getRelatedProductsAttribute()
    {
        if (empty($this->related_product_ids) || !is_array($this->related_product_ids)) {
            return collect();
        }
        return Product::whereIn('id', $this->related_product_ids)->with('brand')->get();
    }
}
