<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];

    public function tags() {
        return $this->belongsToMany(tags::class, 'product_tags', 'product_id', 'tag_id')->withTimestamps();
    }

    public function productImage() { // 1 nhiều
        return $this->hasMany(product_images::class, 'product_id');
    }
}
