<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DraftOrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'draft_order_id',
        'product_id',
        'price',
        'qty',
        'total'
    ];

    public function draftOrder()
    {
        return $this->belongsTo(DraftOrder::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
