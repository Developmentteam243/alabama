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
            $nameOrSku = $model->model_name ? $model->model_name . '-' . $model->sku_code : $model->sku_code;
            $model->slug = \Illuminate\Support\Str::slug($nameOrSku);
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
}
