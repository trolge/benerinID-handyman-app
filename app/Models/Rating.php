<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $primaryKey = 'RatingID';

    protected $fillable = ['Rating', 'feedback', 'JobID', 'HandymanID', 'CustomerID'];

    // CRC Methods
    public static function rateHandyman($data)
    {
        return self::create($data);
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
