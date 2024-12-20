<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    // Define the table if it's different from the default (optional)
    protected $table = 'sliders';

    // Define the fillable fields (those that can be mass-assigned)
    protected $fillable = [
        'image_path',  // Path to the slider image
        'title',       // Title of the slider
        'description', // Description text
        'order',       // Order of the slider (for sorting)
    ];

    // Optionally, you can define timestamps (created_at, updated_at)
    public $timestamps = true;
}
