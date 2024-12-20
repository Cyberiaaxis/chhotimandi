<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     * 
     * This defines the columns in the database that can be mass-assigned.
     * 'category_name' is the only column we allow to be filled directly via user input.
     */
    protected $fillable = [
        'category_name', // Name of the category
    ];

    /**
     * Define the relationship: A category can have many products.
     * 
     * This method establishes a one-to-many relationship between the Category model and the Product model.
     * A category can have multiple products associated with it. 
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        // A category can have many products, linked via the foreign key 'category_id' in the products table
        return $this->hasMany(Product::class);
    }
}
