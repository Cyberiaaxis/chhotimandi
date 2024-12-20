<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * 
 * This model represents the products available in the system. It defines the attributes and 
 * relationships between products and other entities such as categories and discounts.
 * 
 * @package App\Models
 */
class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * These attributes can be mass-assigned when creating or updating a product.
     * The `fillable` array helps protect against mass-assignment vulnerabilities.
     * 
     * @var array
     */
    protected $fillable = [
        'name',          // Name of the product
        'description',   // Description of the product
        'price',         // Price of the product
        'image',         // Image URL or path associated with the product
        'category_id',   // Foreign key for the category the product belongs to
        'is_active'      // A flag indicating whether the product is active or not
    ];

    /**
     * Get the category that the product belongs to.
     * 
     * This method defines a one-to-many inverse relationship between the Product 
     * and Category models. Each product belongs to exactly one category.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the discounts associated with the product.
     * 
     * This method defines a one-to-many relationship between the Product and Discount models.
     * Each product can have multiple associated discounts.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function discounts()
    {
        return $this->hasOne(Discount::class); // A product can have many discounts.
    }
}
