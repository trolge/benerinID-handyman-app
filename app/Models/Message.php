<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $primaryKey = 'MessageID';

    protected $fillable = ['JobID', 'SenderID', 'message', 'is_read'];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    // Relationships
    public function job()
    {
        return $this->belongsTo(Job::class, 'JobID', 'JobID');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'SenderID', 'UserID');
    }
}
