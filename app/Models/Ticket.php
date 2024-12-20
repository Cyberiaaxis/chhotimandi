<?php

// app/Models/Ticket.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'description', 'assigned_to', 'resolution_comment', 'priority'];

    // Relationship with the User (Staff)
    public function assignedStaff()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
