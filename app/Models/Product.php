<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Admin\Category::class, 'category_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Admin\SubCategory::class, 'subcategory_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Admin\Brand::class, 'brand_id', 'id');
    }
}
