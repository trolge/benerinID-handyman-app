<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $primaryKey = 'TransID';

    protected $fillable = ['JobID', 'HandymanID', 'CustomerID'];

    // CRC Methods
    public function doPayment($amount)
    {
        // Payment processing logic
        return true;
    }

    // Relationships
    public function job()
    {
        return $this->belongsTo(Job::class, 'JobID', 'JobID');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'CustomerID', 'UserID');
    }

    public function handyman()
    {
        return $this->belongsTo(User::class, 'HandymanID', 'UserID');
    }
}
