<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name', 'code', 'manufacturer', 'country_of_origin', 'slug', 'description', 'logo_url'];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->slug = \Illuminate\Support\Str::slug($model->name);
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
