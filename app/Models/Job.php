<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'handyman_jobs';
    protected $primaryKey = 'JobID';
    
    protected $fillable = [
        'JobName', 'JobType', 'JobDesk', 'JobImages', 'JobLocation', 'JobLocationLat', 'JobLocationLng', 'HandymanID', 
        'CustomerID', 'JobDuration', 'JobStartDate', 'JobEndDate', 'JobStatus', 'JobPrice', 'InvoiceItems'
    ];

    protected $casts = [
        'JobImages' => 'array',
        'InvoiceItems' => 'array',
    ];

    // CRC Methods
    public function viewJob()
    {
        return $this->toArray();
    }

    public function changeStatus($status)
    {
        $this->JobStatus = $status;
        return $this->save();
    }

    public static function createBook($data)
    {
        return self::create($data);
    }

    public static function autoRejectOldPending()
    {
        self::where('JobStatus', 'pending')
            ->where('created_at', '<', now()->subDays(2))
            ->update(['JobStatus' => 'cancelled']);
    }

    // Relationships
    public function customer()
    {
        return $this->belongsTo(User::class, 'CustomerID', 'UserID');
    }

    public function handyman()
    {
        return $this->belongsTo(User::class, 'HandymanID', 'UserID');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'JobID', 'JobID');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'JobID', 'JobID');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'JobID', 'JobID');
    }
}
