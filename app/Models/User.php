<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'PhoneNumber', 'Role', 'avatar', 'rating', 'WorkingHoursStart', 'WorkingHoursEnd'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'UserID';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // CRC Card Methods
    public static function doRegister(array $data)
    {
        return self::create($data);
    }

    public function doLogin(array $credentials)
    {
        return auth()->attempt($credentials);
    }

    public function verifyEmail()
    {
        $this->email_verified_at = now();
        $this->save();
        return true;
    }

    public function forgotPassword()
    {
        // Trigger password reset email
        return true;
    }

    public function createCaptcha()
    {
        // Generate captcha
        return 'captcha_code';
    }

    public function verifyCaptcha($input)
    {
        // Verify input captcha
        return true;
    }

    public function getUserID()
    {
        return $this->UserID;
    }

    // Relationships
    public function jobsAsCustomer()
    {
        return $this->hasMany(Job::class, 'CustomerID', 'UserID');
    }

    public function jobsAsHandyman()
    {
        return $this->hasMany(Job::class, 'HandymanID', 'UserID');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'HandymanID', 'UserID');
    }
}
