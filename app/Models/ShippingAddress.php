<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'name',
        'email',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'phone'
    ];

    // Optionally, specify if timestamps should be used
    public $timestamps = false;
    /**
     * Get the order that owns the shipping address.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
