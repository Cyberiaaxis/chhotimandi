<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrafficLog extends Model
{
    protected $table = 'traffic_logs';
    protected $fillable = [
        'ip',
        'url',
        'method',
        'user_agent',
        'country',
        'region',
        'city',
        'latitude',
        'longitude'
    ];
}
