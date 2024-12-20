<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{


    // Define the table name (optional if it follows convention)
    protected $table = 'reservations';

    // Define the fillable fields
    protected $fillable = [
        'name',
        'email',
        'phone',
        'table_number',
        'number_guests',
        'date',
        'time',
        'message',
    ];
}
