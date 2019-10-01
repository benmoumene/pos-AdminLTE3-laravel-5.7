<?php

namespace App;

use App\Product;
use App\Provider;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $guarded = [];
    protected $qtys = [
        'quantity' => 'array',
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_purchase', 'purchase_id', 'product_id');
    }
}