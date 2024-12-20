<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Table name if not the plural form of the model name
    protected $table = 'orders';

    // Columns that are mass assignable
    protected $fillable = [
        'user_id',
        'order_date',
        'status',
        'total_amount',
        'discount_code',
        'discount_amount',
        'final_amount',
        'payment_type',
        'payment_status',
        'delivery_status',
        'tracking_number',
        'delivery_date',
        'notes',
    ];

    // Optionally, specify if timestamps should be used
    public $timestamps = true;

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);  // Assuming User model exists
    }

    public function billing()
    {

        return $this->hasOne(BillingAddress::class);
    }

    public function shipping()
    {
        return $this->hasOne(ShippingAddress::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
