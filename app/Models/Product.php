<?php

namespace App\Models;

use Dompdf\Css\Color;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // public function variation()
    // {
    //     return $this->hasMany(ProductVariation:: class);
    // }


    public function product_image()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function product_category()
    {
        return $this->hasMany(ProductWithCategory::class, 'product_id', 'id');
    }


    public function variation_stock()
    {
        return $this->hasMany(ProductStocks::class);
    }


    public function single_stock()
    {
        return $this->belongsTo(ProductStocks::class, 'id', 'product_id')->where('variant', '=', null)->where('color', '=', null);
    }
    public function colors()
    {
        return $this->belongsToMany(Colors::class, 'product_stocks', 'product_id', 'color_id')->distinct();
    }

    public function filter_stock()
    {
        return $this->hasMany(ProductStocks::class, 'product_id', 'id');
    }

    public function scopeFilter($query, $filters)
    {

        // Price range
        if (
            isset($filters['min']) && $filters['min'] !== '' ||
            isset($filters['max']) && $filters['max'] !== ''
        ) {
            $query->whereHas('filter_stock', function ($q) use ($filters) {

                if (isset($filters['min']) && $filters['min'] !== '') {
                    $q->where('price', '>=', (int) $filters['min']);
                }

                if (isset($filters['max']) && $filters['max'] !== '') {
                    $q->where('price', '<=', (int) $filters['max']);
                }
            });
        }
        // Categories
        if (!empty($filters['category_id'])) {
            $query->whereHas('product_category', function ($q) use ($filters) {
                $q->whereIn('category_id', $filters['category_id']);
            });
        }

        // Size filter (variant_output)
        if (!empty($filters['size'])) {
            $query->whereHas('filter_stock', function ($q) use ($filters) {
                $q->whereIn('variant_output', $filters['size']);
            });
        }


        
        // Color filter (product_stocks.color)
        if (!empty($filters['color_id'])) {
            $query->whereHas('filter_stock', function ($q) use ($filters) {
                $q->whereIn('color', $filters['color_id']);
            });
        }


        // Brands
        if (!empty($filters['brand_id'])) {
            $query->whereIn('brand_id', $filters['brand_id']);
        }

        // Fits
        if (!empty($filters['fits'])) {
            $query->whereIn('fit', $filters['fits']);
        }

        // Fabrication
        if (!empty($filters['fabrication'])) {
            $query->whereIn('fabrication', $filters['fabrication']);
        }

        return $query;
    }


}
