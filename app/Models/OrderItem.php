<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // Specify the table name if it's not "order_items" (optional)
    protected $table = 'order_items';

    // Optionally, specify if timestamps should be used
    public $timestamps = false;

    // Define fillable properties for mass assignment
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price',
        'discount',
        'subtotal',
    ];

    // Define the relationship to the Order model
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Optional: Define relationship to Product model if applicable
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
